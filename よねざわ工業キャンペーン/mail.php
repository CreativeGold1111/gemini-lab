<?php
// =====================================================
// メールフォーム送信処理
// =====================================================

// エラー表示を抑制（本番環境用）
ini_set('display_errors', 0);
error_reporting(0);

// =====================================================
// 文字エンコーディング設定（文字化け防止）
// =====================================================
mb_language('uni');                // UTF-8 でメール送信
mb_internal_encoding('UTF-8');    // 内部エンコーディングを UTF-8 に

// JSON レスポンスヘッダー
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// POST以外のリクエストを拒否
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => '不正なリクエストです。']);
    exit;
}

// =====================================================
// 設定
// =====================================================
$admin_email = 'nitta@yonezawa-k.co.jp, hiroki-takahashi@yonezawa-k.co.jp, ta-yanagawa@yonezawa-k.co.jp, iti69ichi+yoezawa@gmail.com, okamoto@flag-hokkaido.com'; // 管理者宛メールアドレス（複数）
$from_email  = 'noreply@yonezawa-k.co.jp';      // 送信元アドレス
$from_name   = '株式会社よねざわ工業';             // 送信元名

// =====================================================
// フォームデータ取得・サニタイズ
// =====================================================
$name      = isset($_POST['name'])      ? trim(htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8'))      : '';
$person    = isset($_POST['person'])    ? trim(htmlspecialchars($_POST['person'], ENT_QUOTES, 'UTF-8'))    : '';
$tel       = isset($_POST['tel'])       ? trim(htmlspecialchars($_POST['tel'], ENT_QUOTES, 'UTF-8'))       : '';
$email     = isset($_POST['email'])     ? trim(htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8'))     : '';
$panels    = isset($_POST['panels'])    ? trim(htmlspecialchars($_POST['panels'], ENT_QUOTES, 'UTF-8'))    : '';
$delivery  = isset($_POST['delivery'])  ? trim(htmlspecialchars($_POST['delivery'], ENT_QUOTES, 'UTF-8'))  : '';
$status    = isset($_POST['status'])    ? trim(htmlspecialchars($_POST['status'], ENT_QUOTES, 'UTF-8'))    : '';
$message   = isset($_POST['message'])   ? trim(htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8'))   : '';

// =====================================================
// バリデーション
// =====================================================
$errors = [];
if (empty($name))     $errors[] = 'お名前または会社名を入力してください。';
if (empty($tel))      $errors[] = '電話番号を入力してください。';
if (empty($email))    $errors[] = 'メールアドレスを入力してください。';
if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($email)) $errors[] = 'メールアドレスの形式が正しくありません。';
if (empty($panels))   $errors[] = 'パネルの枚数を入力してください。';
if (empty($delivery)) $errors[] = 'お引渡し方法を選択してください。';

if (!empty($errors)) {
    echo json_encode(['success' => false, 'message' => implode("\n", $errors)]);
    exit;
}

// =====================================================
// 管理者宛メール作成
// =====================================================
$admin_subject = '【LP】太陽光パネル お問い合わせ';

$admin_body = <<<EOT
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
　太陽光パネル LP お問い合わせ
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

以下の内容でお問い合わせがありました。

■ お名前 / 会社名
　{$name}

■ ご担当者名
　{$person}

■ 電話番号
　{$tel}

■ メールアドレス
　{$email}

■ パネルの枚数（概算）
　{$panels} 枚

■ ご希望のお引渡し方法
　{$delivery}

■ 現在の状況
　{$status}

■ お問い合わせ内容・ご相談
　{$message}

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
このメールはWebサイトのお問い合わせフォームから
自動送信されています。
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
EOT;

// =====================================================
// 自動返信メール作成
// =====================================================
$reply_subject = '【株式会社よねざわ工業】太陽光パネルリサイクルのお問い合わせありがとうございます';

$reply_body = <<<EOT
{$name} 様

この度は、太陽光パネルリサイクルキャンペーンにお問い合わせいただき誠にありがとうございます。内容を確認の上、3営業日以内に担当者よりお電話またはメールにてご連絡差し上げます。今しばらくお待ちいただけますと幸いです。

──────────────────────────────
株式会社よねざわ工業
〒061-1405 北海道恵庭市戸磯596番地6
TEL：011-823-6886 ／ FAX：011-812-9194
公式サイト：http://www.yonezawa-k.co.jp
──────────────────────────────

※ このメールは自動返信メールです。
※ このメールに直接ご返信いただいても
　 対応できませんのでご了承ください。
EOT;

// =====================================================
// メール送信ヘッダー（文字化け・迷惑メール対策）
// =====================================================

// MIMEエンコードした送信者名
$encoded_from_name = mb_encode_mimeheader($from_name, 'UTF-8', 'B');

// 管理者宛ヘッダー
$admin_headers  = "MIME-Version: 1.0\r\n";
$admin_headers .= "From: {$encoded_from_name} <{$from_email}>\r\n";
$admin_headers .= "Reply-To: {$email}\r\n";
$admin_headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
$admin_headers .= "Content-Transfer-Encoding: 8bit\r\n";
$admin_headers .= "Organization: 株式会社よねざわ工業";

// 自動返信ヘッダー
$reply_headers  = "MIME-Version: 1.0\r\n";
$reply_headers .= "From: {$encoded_from_name} <{$from_email}>\r\n";
$reply_headers .= "Reply-To: {$from_email}\r\n";
$reply_headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
$reply_headers .= "Content-Transfer-Encoding: 8bit\r\n";
$reply_headers .= "Organization: 株式会社よねざわ工業";

// envelope sender（迷惑メール対策：Return-Path を設定）
$envelope_params = "-f {$from_email}";

// =====================================================
// メール送信
// =====================================================
$admin_result = mb_send_mail($admin_email, $admin_subject, $admin_body, $admin_headers, $envelope_params);
$reply_result = mb_send_mail($email, $reply_subject, $reply_body, $reply_headers, $envelope_params);

if ($admin_result) {
    echo json_encode(['success' => true, 'message' => 'お問い合わせを送信しました。']);
} else {
    echo json_encode(['success' => false, 'message' => '送信に失敗しました。時間をおいて再度お試しください。']);
}
exit;
?>

/**
 * ============================================================
 *  見積もりシミュレーター - 設定ファイル
 *
 *  【初回セットアップ】
 *  admin.html を開いて設定し、「ユーザー設定を保存」でJSONファイルを
 *  ダウンロードしてください。次回以降は「ユーザー設定を読込」で
 *  そのJSONファイルを読み込むだけで設定が反映されます。
 *
 *  【テンプレートの切り替え】
 *  admin.html の「テンプレートを読込」から templates/ フォルダ内の
 *  JSONファイルを読み込むと、見積もりの種類を切り替えられます。
 *  ・flex-estimate.json: 汎用版（フリーStep形式）
 *  ・web-estimate.json:  Web制作版（4ステップ固定＋フリーStep）
 * ============================================================
 */

/* ============================================================
   ① 会社・ブランド情報
   （コピーテキスト・PDF見積書のフッターに使用されます）
============================================================ */
const SETTINGS = {
    /* 社名 */
    companyName: '株式会社〇〇',
    /* 担当者名 */
    personName: '山田 太郎',
    /* メールアドレス */
    email: 'info@example.com',
    /* WebサイトURL */
    url: 'https://example.com/',
    /* 担当部署 */
    department: '',
    /* 郵便番号 */
    postalCode: '',
    /* 住所 */
    address: '',
    /* 電話番号 */
    tel: '',
    /* FAX番号 */
    fax: '',
    /* 問い合わせページURL（「この内容で相談する」ボタンの遷移先） */
    contactUrl: 'https://example.com/contact/',

    /* SNS（任意：不要な行は削除、追加も可能）
       { label: '表示名', url: 'https://...' } の形式で配列に追加 */
    sns: [
        { label: 'Twitter',   url: '' },
        { label: 'Instagram', url: '' },
    ],

    /* ロゴ画像（Base64形式）
       ・admin.html のロゴアップロード機能で自動設定されます
       ・未設定（空文字）の場合は、社名テキストを表示します */
    logoBase64: '',

    /* PDF見積書タイトル */
    pdfTitle: '概算お見積書',
    /* PDF注記（見積書下部に表示される注意書き） */
    pdfNote: '・本お見積りはシミュレーターによる概算です。実際の費用は要件確認後に正式なお見積りをご提示いたします。\n・掲載金額はすべて税抜表記です。',

    /* 結果ページ 注意書き（見積もり結果ページ下部に表示） */
    disclaimer: '※ 本ツールの見積もりは概算です。実際の金額はヒアリング内容・要件定義により変動します。正式なお見積もりはお問い合わせください。',

    /* ツールタイトル（ブラウザタブ・ヘッダーに表示） */
    toolTitle: '見積もりくん',
    /* ツールサブタイトル */
    toolSubtitle: '選択するだけで概算金額を即座に算出。',

    /* localStorage キー（複数インストール時の衝突防止。基本変更不要） */
    storageKey: 'mitsumori_kun_v1',

    /* テンプレートタイプ（'flex': 汎用版 / 'web': Web制作版） */
    templateType: 'web',
    /* テンプレート名（表示用） */
    templateName: 'WEB制作版テンプレート',

    /* ディレクション費設定 */
    directionFeeType:  'percent',   /* 'percent' | 'fixed' | 'none' */
    directionFeeValue: 15,          /* percent の場合は %、fixed の場合は円 */

    /* 消費税率（%） */
    taxRate: 10,

    /* ------------------------------------------------------------------
       カラー設定
    ------------------------------------------------------------------ */
    colorPrimary:       '#C8A84E',
    colorSecondary:     '#1a1a1a',
    colorBg:            '#F7F6F3',
    colorAccentBg:      '#fff8f5',
    colorAccentBorder:  '#C8A84E',
    colorWarningBg:     '#fffbeb',
    colorWarningText:   '#b45309',
    colorWarningBorder: '#fde68a',
    colorPanelHeadBg:   '#ffffff',
    colorPanelHeadText: '#1a1a1a',
    colorCardSubText:   '#6b7280',
};


/* ============================================================
   ② Web制作版 固定Step 価格定数
   （templateType が 'web' の場合のみ使用）
============================================================ */
const S2_TOP_PRICE_LP  = 60000;   // LPのトップページ価格
const S2_TOP_PRICE_STD = 60000;   // 通常サイトのトップページ価格
const LP_SECTION_PRICE = 15000;   // LP追加セクション1つあたりの価格


/* ============================================================
   ③ Web制作版 STEP1：サイトタイプ
   （templateType が 'web' の場合のみ使用）
============================================================ */
const STEP1_ITEMS = [
    { id: 's1_lp',      label: 'ランディングページ (LP)', sub: '1ページ・5セクション', isLP: true, help: '特定の商品・サービスに絞った1ページ完結の縦長のウェブページです。集客やお問い合わせを強く促したい場合に適しています。'  },
    { id: 's1_web',     label: 'ウェブサイト（複数ページ）',                           isLP: false, help: 'トップページ、会社概要、サービス紹介など、複数のページで構成される一般的なホームページです。' },
    { id: 's1_recruit', label: '採用サイト',                                            isLP: false },
    { id: 's1_ec',      label: 'ECサイト',                                              isLP: false, help: 'ネット上で商品を販売し、クレジットカード等で決済ができるオンラインショップのことです。' },
    { id: 's1_media',   label: 'メディア・ブログサイト',                               isLP: false },
];


/* ============================================================
   ④ Web制作版 STEP2：ページ構成
   （templateType が 'web' の場合のみ使用）
============================================================ */
const STEP2_CATS = [
    { label: '必須', items: [
        { id: 's2_top',       label: 'トップページ',                       price: 60000, pages: 1, required: true, maxQty: 1 },
    ]},
    { label: '基本情報', items: [
        { id: 's2_concept',   label: '私たちについて',                     price: 15000, pages: 1 },
        { id: 's2_service',   label: 'サービス紹介',                       price: 15000, pages: 1 },
        { id: 's2_company',   label: '会社概要',                           price: 10000, pages: 1 },
        { id: 's2_message',   label: '代表からのメッセージ',               price: 15000, pages: 1 },
        { id: 's2_profile',   label: 'プロフィール',                       price: 15000, pages: 1 },
        { id: 's2_access',    label: 'アクセス・地図',                     price: 10000, pages: 1 },
    ]},
    { label: '実績・商品', items: [
        { id: 's2_works',     label: '実績紹介（一覧・詳細）',             price: 30000, pages: 2 },
        { id: 's2_product',   label: '商品紹介（一覧・詳細）',             price: 30000, pages: 2 },
        { id: 's2_staff',     label: 'スタッフ・社員紹介（一覧・詳細）',   price: 30000, pages: 2 },
        { id: 's2_blog',      label: 'ブログ・お知らせ（一覧・詳細）',     price: 30000, pages: 2 },
        { id: 's2_voice',     label: 'お客様の声（一覧）',                 price: 20000, pages: 1 },
        { id: 's2_faq',       label: 'よくある質問（一覧）',               price: 20000, pages: 1 },
    ]},
    { label: '法的・規約', items: [
        { id: 's2_privacy',   label: 'プライバシーポリシー',               price: 10000, pages: 1 },
        { id: 's2_terms',     label: '利用規約',                           price: 10000, pages: 1 },
        { id: 's2_tokusho',   label: '特定商取引法に基づく表記',           price: 10000, pages: 1, help: 'ネット上で商品を販売する場合などに、法律で記載が義務付けられているページです。事業者名・所在地・連絡先などを明記します。' },
    ]},
    { label: 'その他', items: [
        { id: 's2_contact',   label: 'お問い合わせページ',                 price: 10000, pages: 1 },
        { id: 's2_recruit',   label: '採用募集要項一覧（簡易一覧）',       price: 20000, pages: 1 },
        { id: 's2_recruitlp', label: '採用情報LP（5セクション）',           price: 60000, pages: 1 },
        { id: 's2_gallery',   label: 'ギャラリー・フォト',                 price: 20000, pages: 1 },
        { id: 's2_404',       label: '404エラーページ',                    price: 10000, pages: 1 },
    ]},
];


/* ============================================================
   ⑤ Web制作版 STEP3：機能・演出
   （templateType が 'web' の場合のみ使用）
============================================================ */
const STEP3_ITEMS = [
    { id: 's3_form',      label: 'お問い合わせフォーム機能実装',          price:  20000 },
    { id: 's3_slider',    label: 'スライダー・カルーセル実装',            price:  20000, help: '複数の画像が数秒ごとに横にスライドして切り替わる機能です。トップページの上部などでよく使われます。' },
    { id: 's3_anime',     label: 'アニメーション演出（フェードイン等）',   price:  20000, help: 'スクロールに合わせて文字がフワッと現れたり、写真が下から上がってくるような動きを付けます。' },
    { id: 's3_gsap',      label: '高度なアニメーション（GSAP等）',        price:  45000, help: '通常のアニメーションよりも、より滑らかで複雑な動きや、スクロールの動きにピタッと連動するようなリッチな演出を追加します。' },
    { id: 's3_gmap',      label: 'Googleマップ埋め込み',                  price:   5000 },
    { id: 's3_sns',       label: 'SNS連携（フィード表示）',               price:  15000, help: 'InstagramやX(旧Twitter)の最新の投稿を、ホームページ内に自動で読み込んで表示させます。' },
    { id: 's3_search',    label: 'サイト内検索機能',                      price:  30000 },
    { id: 's3_multilang', label: '多言語対応切り替え機能', sub: '※多言語のテキストデータはご用意ください', price: 90000 },
];


/* ============================================================
   ⑥ Web制作版 STEP4：システム・設定
   （templateType が 'web' の場合のみ使用）
============================================================ */
/* ページ数×単価（LP時は calcTotals() で別途処理） */
const STEP4_VAR = [
    { id: 's4_resp', label: 'レスポンシブ対応',  unitPrice: 5000, help: 'PCだけでなく、スマートフォンやタブレットで見ても自動的にレイアウトが最適化されて見やすく表示される仕組みです。現在は必須の対応です。' },
    { id: 's4_seo',  label: '基本的なSEO設定',   unitPrice: 5000, help: '検索エンジン（Google等）で上位に表示されやすくするための内部的なタグ等の設定です。（※必ず上位表示されることを保証するものではございません）' },
];

/* 固定価格 */
const STEP4_FIX = [
    { id: 's4_wp',       label: 'WordPress構築',              price:  80000, help: 'お客様ご自身でお知らせやブログ、制作実績などを簡単に更新できるシステム（CMS）のことです。世界中で最も広く使われています。' },
    { id: 's4_ec',       label: 'EC機能実装（構築とテスト含む）', price: 200000, help: 'ネットショップ機能のことです。カート機能、クレジットカードなどの決済機能、マイページ機能などが含まれます。' },
    { id: 's4_ga4',      label: 'アクセス解析タグ設置 (GA4)', price: 10000, help: 'Googleアナリティクスという無料のアクセス解析ツールを設定します。誰が・どこから・何人来ているかなどのデータが分かるようになります。' },
    { id: 's4_server',   label: 'サーバー・ドメイン設定代行', price: 15000, help: 'サーバーはホームページの「土地」、ドメインは「住所(〇〇.comなど)」のことです。取得や設定にかかる専門的な作業を代行いたします。' },
    { id: 's4_security', label: 'WordPressセキュリティ対策',  price: 30000 },
];


/* ============================================================
   ⑦ フリーStep（汎用版では Step1以降、Web制作版では Step5以降）
   チェックボックス型で複数選択・価格加算方式です。
============================================================ */
const FREE_STEPS = [
    {
        id: 'fs_dtp_01',
        title: 'ロゴ・CI制作',
        items: [
            { id: 'fs_logo_1', label: 'シンプルロゴ制作（文字＋シンボル）', price: 50000 },
            { id: 'fs_logo_2', label: '本格ロゴ制作（コンセプト・CI/VI設計込）', price: 150000 },
            { id: 'fs_logo_3', label: 'ロゴ使用ガイドライン作成', price: 30000 },
        ]
    },
    {
        id: 'fs_dtp_02',
        title: '名刺・カードデザイン',
        items: [
            { id: 'fs_card_1', label: '名刺デザイン（片面）', price: 20000 },
            { id: 'fs_card_2', label: '名刺デザイン（両面）', price: 30000 },
            { id: 'fs_card_3', label: 'ショップカード（両面・地図作成含む）', price: 30000 },
            { id: 'fs_card_4', label: 'スタンプ・ポイントカード', price: 30000 },
        ]
    },
    {
        id: 'fs_dtp_03',
        title: 'チラシ・ポスターデザイン',
        items: [
            { id: 'fs_flyer_1', label: 'A4チラシ・フライヤー（片面）', price: 40000 },
            { id: 'fs_flyer_2', label: 'A4チラシ・フライヤー（両面）', price: 70000 },
            { id: 'fs_flyer_3', label: 'B5/A5フライヤー（片面）', price: 30000 },
            { id: 'fs_flyer_4', label: 'B2/A2ポスターデザイン', price: 50000 },
        ]
    },
    {
        id: 'fs_dtp_04',
        title: 'パンフレット・冊子デザイン',
        items: [
            { id: 'fs_pamph_1', label: '2つ折りパンフレット（A4仕上がり 4P相当）', price: 100000 },
            { id: 'fs_pamph_2', label: '3つ折りパンフレット（A4仕上がり 6P相当）', price: 150000 },
            { id: 'fs_pamph_3', label: '会社案内・カタログ（中綴じ 8P〜）', price: 200000 },
            { id: 'fs_pamph_4', label: 'ページ追加（4Pごと）', price: 80000 },
        ]
    },
    {
        id: 'fs_dtp_05',
        title: 'その他の制作・オプション',
        items: [
            { id: 'fs_other_1', label: 'WEB用バナー制作（1サイズあたり）', price: 10000 },
            { id: 'fs_other_2', label: 'SNS用ヘッダー・画像制作（3点セット）', price: 20000 },
            { id: 'fs_other_3', label: 'オリジナル封筒・レターヘッドデザイン', price: 20000 },
            { id: 'fs_other_4', label: '印刷手配代行費（印刷代は別途実費）', price: 10000 },
            { id: 'fs_other_5', label: '特急制作（通常の半分以下の工期）', price: 30000 },
        ]
    },
];

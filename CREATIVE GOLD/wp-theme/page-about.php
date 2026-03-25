<?php
/**
 * Template Name: About Us
 * Description: Custom template for the About page with redaction gimmick
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// Ensure we load the correct theme classes on body for black theme if needed
add_filter('body_class', function($classes) {
    if (is_page('about') || is_page_template('page-about.php')) {
        $theme = isset($_COOKIE['cg_theme']) ? $_COOKIE['cg_theme'] : 'top-b';
        if (in_array($theme, ['top-a', 'top-b', 'top-c'])) {
            $classes[] = $theme;
        }
    }
    return $classes;
});

get_header(); 
?>

<main id="main_content" style="min-height: 100vh;">
    
    <!-- Hero Section -->
    <section class="about-hero container reveal">
        <span class="label-parenthesis" style="font-size:11px; letter-spacing:0.2em; color:var(--text-muted); display:inline-block; margin-bottom:2rem;">私たちについて</span>
        <h1 class="about-title">ABOUT US</h1>
        <p class="about-subtitle">
            CREATIVE GOLDは、ビジネスの課題をクリエイティブの力で解決するデザイン事務所です。<br>
            ただ作るだけでなく、なぜ作るのかを共に考えます。
        </p>
    </section>

    <div class="container" style="padding: 0 5vw; max-width: 1400px; margin: 0 auto;">
        
        <!-- SECTIONS -->
        
        <!-- 1. Profile -->
        <section class="about-section reveal" id="profile">
            <h2 class="section-heading">Profile</h2>
            <div class="profile-grid">
                <div class="profile-img" style="aspect-ratio: 1/1; background: var(--bg-soft); border: 1px solid var(--border);">
                    <!-- Avatar placeholder -->
                    <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: var(--text-muted); font-family: 'Outfit';">IMAGE PLACEHOLDER</div>
                </div>
                <div class="profile-text">
                    <h3 style="font-size: 24px; font-weight: 500; margin-bottom: 2rem; line-height: 1.4;">
                        金田一 樹生<span style="font-size: 14px; color: var(--text-muted); margin-left: 1rem; font-family: 'Outfit';">Tatsuo Kindaichi</span><br>
                        <span style="font-size: 14px; font-weight: 400; color: var(--text-muted);">CREATIVE GOLD 代表 / デザイナー / ディレクター</span>
                    </h3>
                    <p style="line-height: 2; color: var(--text-muted); font-size: 15px;">
                        2010年よりデザインの道へ。<br>
                        2019年2月13日、個人事業主として「CREATIVE GOLD」を開業。<br>
                        2026年3月、役員を務めた制作会社 willplant を退任し、再びフリーランスとして独立。<br>
                        2026年4月より、専門学校での講師活動を再開。<br>
                        現在は札幌を拠点に、Web・グラフィック・システム・講師業と、領域を問わず活動中。
                    </p>
                </div>
            </div>
        </section>

        <!-- 2. Overview -->
        <section class="about-section reveal" id="overview">
            <h2 class="section-heading">Overview</h2>
            <div class="overview-content" style="max-width: 800px;">
                <h3 style="font-size: clamp(24px, 3vw, 32px); font-weight: 500; margin-bottom: 2rem; line-height: 1.5; color: var(--text-main);">
                    やらなきゃいけないこと、どうやって？
                </h3>
                <p style="line-height: 2; color: var(--text-muted); margin-bottom: 2rem; font-size: 15px;">
                    やらなきゃいけないことはあるけど、どこから手をつけたらいいかわからない。<br>
                    そんな悩みを言語化して、今必要なことを整理するのが得意分野です。
                </p>
                <p style="line-height: 2; color: var(--text-muted); margin-bottom: 2rem; font-size: 15px;">
                    制作会社の役員として事業の数字と向き合ってきた視点と、15年以上現場で泥臭く手を動かし続けてきた経験。<br>
                    この両輪があるからこそ、単なる制作に留まらない、ビジネスの現在地に最適化した解決策を提案できると考えています。
                </p>
                <p style="line-height: 2; color: var(--text-muted); margin-bottom: 3rem; font-size: 15px;">
                    また、最新のAIツールを徹底的に使いつつ、できないことは専門家に任せる。<br>
                    今、自分が考えるべき「そもそも何をするべきか」という本質的な問いに時間を割く。<br>
                    それが、変化の激しい今の時代において、確実な結果を出すための僕なりのスタイルだと考えています。
                </p>
                
                <a href="<?php echo home_url('/'); ?>#service" class="btn-service" style="display: inline-flex; align-items: center; gap: 1rem; padding: 1rem 3rem; background-color: var(--text-main); color: var(--bg-darker); text-decoration: none; font-family: 'Outfit'; font-weight: 700; letter-spacing: 0.1em; transition: opacity 0.3s; border-radius: 4px;">
                    SERVICES
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                </a>
                <style>
                    .btn-service:hover { opacity: 0.8; }
                </style>
            </div>
        </section>

        <!-- 3. History with REDACTION GIMMICK -->
        <section class="about-section reveal" id="history">
            <h2 class="section-heading">History / 16年の生存記録</h2>
            
            <p style="margin-bottom: 3rem; line-height: 1.8; color: var(--text-muted);">
                これまでの人生と、携わらせていただいたプロジェクトの生存記録です。<br>
                ※一部の企業・クライアント名は、機密保持のため<span class="redacted">黒塗り</span>されています。
            </p>

            <div class="history-content" style="margin-top: 4rem;">
                <ul style="list-style: none; padding: 0;">
                    
                    <li style="display: flex; gap: 2rem; margin-bottom: 2.5rem; border-bottom: 1px dotted rgba(255,255,255,0.15); padding-bottom: 2.5rem; flex-wrap: wrap;">
                        <div style="font-family: 'Outfit'; font-weight: 700; width: 80px; flex-shrink: 0; font-size: 1.25rem; color: var(--text-main);">1990</div>
                        <div style="line-height: 1.8; color: var(--text-muted); flex: 1; min-width: 250px;">
                            金田一、爆誕。<br>
                            父は俳優、<button class="youtube-popup-trigger" data-video-id="G7DQVG4tZZo" style="background:none; border:none; padding:0; color: var(--primary-blue, #c3ff00); text-decoration: underline; text-decoration-style: dotted; text-underline-offset: 4px; transition: opacity 0.3s; display: inline-flex; align-items: center; gap: 4px; cursor: pointer; font-size: inherit; font-family: inherit;">高砂温泉の仙人<svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg></button>。<br>
                            舞台の上で、16年間歌って踊って育つ。
                        </div>
                    </li>

                    <li style="display: flex; gap: 2rem; margin-bottom: 2.5rem; border-bottom: 1px dotted rgba(255,255,255,0.15); padding-bottom: 2.5rem; flex-wrap: wrap;">
                        <div style="font-family: 'Outfit'; font-weight: 700; width: 80px; flex-shrink: 0; font-size: 1.25rem; color: var(--text-main);">2010</div>
                        <div style="line-height: 1.8; color: var(--text-muted); flex: 1; min-width: 250px;">
                            デザインの道へ。<br>
                            講師から誘われ就活を終えるも、卒業直前に捨てられる。<br>
                            コンビニで再会した恩師から、<span class="redacted">全く知らない女の子</span>を紹介される。<br>
                            「絶対に見返してやる」と、独学でデザインを始める。
                        </div>
                    </li>

                    <li style="display: flex; gap: 2rem; margin-bottom: 2.5rem; border-bottom: 1px dotted rgba(255,255,255,0.15); padding-bottom: 2.5rem; flex-wrap: wrap;">
                        <div style="font-family: 'Outfit'; font-weight: 700; width: 80px; flex-shrink: 0; font-size: 1.25rem; color: var(--text-main);">2011</div>
                        <div style="line-height: 1.8; color: var(--text-muted); flex: 1; min-width: 250px;">
                            最初の仕事。1ヶ月働いて1万円。時給換算、19円。<br>
                            履歴書も契約も知らない、何も知らない20歳。<br>
                            逃げるように辞め、ゴミ屋敷の清掃や孤独死の現場を片付けて食い繋ぐ。
                        </div>
                    </li>

                    <li style="display: flex; gap: 2rem; margin-bottom: 2.5rem; border-bottom: 1px dotted rgba(255,255,255,0.15); padding-bottom: 2.5rem; flex-wrap: wrap;">
                        <div style="font-family: 'Outfit'; font-weight: 700; width: 80px; flex-shrink: 0; font-size: 1.25rem; color: var(--text-main);">2012</div>
                        <div style="line-height: 1.8; color: var(--text-muted); flex: 1; min-width: 250px;">
                            職業訓練校でWebを学ぶ。<br>
                            アパレル会社に就職し、200商品のセールページを手書きコードで更新する日々。<br>
                            「楽をしたい」一心で、エクセルを使った最初の効率化ツールを自作。<br>
                            作業時間が5日から3時間になり、その後、会社が倒産。
                        </div>
                    </li>

                    <li style="display: flex; gap: 2rem; margin-bottom: 2.5rem; border-bottom: 1px dotted rgba(255,255,255,0.15); padding-bottom: 2.5rem; flex-wrap: wrap;">
                        <div style="font-family: 'Outfit'; font-weight: 700; width: 80px; flex-shrink: 0; font-size: 1.25rem; color: var(--text-main);">2014</div>
                        <div style="line-height: 1.8; color: var(--text-muted); flex: 1; min-width: 250px;">
                            <span class="redacted">トランスコスモス株式会社</span>へ。<br>
                            8人で回していた案件を、自作ツールを駆使して3人で完結させる。<br>
                            「効率化しても給料は上がらない」と悟り、余った時間でデザインを磨く。<br>
                            効率化システムだけを残して、退職。
                        </div>
                    </li>

                    <li style="display: flex; gap: 2rem; margin-bottom: 2.5rem; border-bottom: 1px dotted rgba(255,255,255,0.15); padding-bottom: 2.5rem; flex-wrap: wrap;">
                        <div style="font-family: 'Outfit'; font-weight: 700; width: 80px; flex-shrink: 0; font-size: 1.25rem; color: var(--text-main);">2016</div>
                        <div style="line-height: 1.8; color: var(--text-muted); flex: 1; min-width: 250px;">
                            高校の友人と映像会社を設立。<br>
                            <span class="redacted">サントリー</span>や<span class="redacted">セコマ</span>など、大手企業のキャンペーンを形にする。<br>
                            「友達でいたいから」という理由で、円満に離脱。
                        </div>
                    </li>

                    <li style="display: flex; gap: 2rem; margin-bottom: 2.5rem; border-bottom: 1px dotted rgba(255,255,255,0.15); padding-bottom: 2.5rem; flex-wrap: wrap;">
                        <div style="font-family: 'Outfit'; font-weight: 700; width: 80px; flex-shrink: 0; font-size: 1.25rem; color: var(--text-main);">2017</div>
                        <div style="line-height: 1.8; color: var(--text-muted); flex: 1; min-width: 250px;">
                            飲食企業のデザイン事業部長へ。<br>
                            知らないおじいちゃんと裸の付き合い。<br>
                            まさかのその人が<span class="redacted">豊平峡温泉</span>のオーナー、サイトリニューアルが決まる。<br>
                            人生、何が起きるかわからない。
                        </div>
                    </li>

                    <li style="display: flex; gap: 2rem; margin-bottom: 2.5rem; border-bottom: 1px dotted rgba(255,255,255,0.15); padding-bottom: 2.5rem; flex-wrap: wrap;">
                        <div style="font-family: 'Outfit'; font-weight: 700; width: 80px; flex-shrink: 0; font-size: 1.25rem; color: var(--text-main);">2019</div>
                        <div style="line-height: 1.8; color: var(--text-muted); flex: 1; min-width: 250px;">
                            北海道胆振東部地震。所属していたチームが解散。<br>
                            2月13日、<span style="color: var(--text-main); font-weight: 500;">CREATIVE GOLD 開業</span>。
                        </div>
                    </li>

                    <li style="display: flex; gap: 2rem; margin-bottom: 2.5rem; border-bottom: 1px dotted rgba(255,255,255,0.15); padding-bottom: 2.5rem; flex-wrap: wrap;">
                        <div style="font-family: 'Outfit'; font-weight: 700; width: 80px; flex-shrink: 0; font-size: 1.25rem; color: var(--text-main);">2020</div>
                        <div style="line-height: 1.8; color: var(--text-muted); flex: 1; min-width: 250px;">
                            独立初年度、目標以上の売り上げを出し、震える。<br>
                            縁あって willplant に所属。Webチームを立ち上げる。
                        </div>
                    </li>

                    <li style="display: flex; gap: 2rem; margin-bottom: 2.5rem; border-bottom: 1px dotted rgba(255,255,255,0.15); padding-bottom: 2.5rem; flex-wrap: wrap;">
                        <div style="font-family: 'Outfit'; font-weight: 700; width: 80px; flex-shrink: 0; font-size: 1.25rem; color: var(--text-main);">2022</div>
                        <div style="line-height: 1.8; color: var(--text-muted); flex: 1; min-width: 250px;">
                            取締役、就任。より深く経営と数字に向き合う。<br>
                            多忙につき、専門学校の講師を一度引退。
                        </div>
                    </li>

                    <li style="display: flex; gap: 2rem; margin-bottom: 2.5rem; padding-bottom: 2.5rem; flex-wrap: wrap;">
                        <div style="font-family: 'Outfit'; font-weight: 700; width: 80px; flex-shrink: 0; font-size: 1.25rem; color: var(--text-main);">2026</div>
                        <div style="line-height: 1.8; color: var(--text-muted); flex: 1; min-width: 250px;">
                            willplantを卒業。再び、フットワークの軽い個人に戻る。<br>
                            就労支援施設や、かつての専門学校。教壇に立つ日々と、現場のクリエイティブを全力で楽しむ8年目の春。
                        </div>
                    </li>

                </ul>
            </div>
        </section>

    </div>
</main>

<!-- Floating Decryption Popup -->
<div id="decrypt-popup" class="decrypt-popup hidden">
    <button id="close-popup" style="position: absolute; top: 10px; right: 10px; background: none; border: none; color: var(--text-muted); cursor: pointer; display: flex; align-items: center; justify-content: center; width: 30px; height: 30px;">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
    </button>
    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 0.5rem;">
        <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="color: #ffaa00;">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
        </svg>
        <h3 style="font-family: 'Outfit'; letter-spacing: 0.05em; font-size: 14px; font-weight: 700; color: #fff;">RESTRICTED INFO DETECTED</h3>
    </div>
    <p style="font-size: 13px; color: var(--text-muted); line-height: 1.5; margin-bottom: 1rem;">
        名刺のパスワードを入力して機密情報を閲覧しますか？
    </p>
    <div class="decrypt-form">
        <input type="password" id="history-password" class="decrypt-input" placeholder="Secret Password">
        <button type="button" id="decrypt-btn" class="decrypt-btn">DECRYPT</button>
    </div>
    <p id="decrypt-error" style="color: #ff4444; font-size: 12px; margin-top: 0.5rem; display: none;">パスワードが正しくありません。</p>
    <p id="decrypt-success" style="color: #c3ff00; font-size: 12px; margin-top: 0.5rem; font-family: 'Outfit'; display: none;">ACCESS GRANTED.</p>
</div>

<!-- YouTube Video Modal -->
<div id="youtube-modal" class="youtube-modal hidden">
    <div class="youtube-modal-bg" id="close-youtube-bg"></div>
    <div class="youtube-modal-content">
        <button id="close-youtube-btn" class="close-youtube-btn">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>
        <div class="video-container">
            <iframe id="youtube-iframe" width="560" height="315" src="" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div>
</div>

<!-- Add inline script for the animation to run seamlessly on this template -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Reveal logic overlaps with common.js, so we skip if common.js handles .reveal, 
    // but we need to power the popup logic precisely.
    
    // ----------------------------------------------------
    // YouTube Modal Gimmick
    // ----------------------------------------------------
    const ytTriggers = document.querySelectorAll('.youtube-popup-trigger');
    const ytModal = document.getElementById('youtube-modal');
    const ytIframe = document.getElementById('youtube-iframe');
    const closeYtBtn = document.getElementById('close-youtube-btn');
    const closeYtBg = document.getElementById('close-youtube-bg');

    const openYtModal = (videoId) => {
        ytIframe.src = `https://www.youtube.com/embed/${videoId}?autoplay=1`;
        ytModal.classList.remove('hidden');
    };

    const closeYtModal = () => {
        ytModal.classList.add('hidden');
        ytIframe.src = ''; // stop video
    };

    ytTriggers.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            openYtModal(btn.dataset.videoId);
        });
    });

    if (closeYtBtn) closeYtBtn.addEventListener('click', closeYtModal);
    if (closeYtBg) closeYtBg.addEventListener('click', closeYtModal);

    // ----------------------------------------------------
    // Redaction Decryption Gimmick (Floating Popup)
    // ----------------------------------------------------
    const passInput = document.getElementById('history-password');
    const decryptBtn = document.getElementById('decrypt-btn');
    const errorMsg = document.getElementById('decrypt-error');
    const successMsg = document.getElementById('decrypt-success');
    const popup = document.getElementById('decrypt-popup');
    const closeBtn = document.getElementById('close-popup');

    if (!popup) return;

    let isDecrypted = false;
    let isPopupDismissed = false;

    // Observer to show popup when redacted text is visible
    const redactedObserver = new IntersectionObserver((entries) => {
        if (isDecrypted || isPopupDismissed) return;
        
        let anyVisible = false;
        entries.forEach(entry => {
            if (entry.isIntersecting) anyVisible = true;
        });

        if (anyVisible) {
            popup.classList.remove('hidden');
        } else {
            popup.classList.add('hidden');
        }
    }, { threshold: 0.5 }); // Trigger when at least 50% of the redacted block is visible

    document.querySelectorAll('.redacted').forEach(el => {
        redactedObserver.observe(el);
    });

    // Close button logic
    closeBtn.addEventListener('click', () => {
        isPopupDismissed = true;
        popup.classList.add('hidden');
    });

    const SECRET_PASSWORD = 'mitene';

    const attemptDecryption = () => {
        if (passInput.value === SECRET_PASSWORD) {
            isDecrypted = true;
            errorMsg.style.display = 'none';
            successMsg.style.display = 'block';
            passInput.disabled = true;
            decryptBtn.disabled = true;
            decryptBtn.textContent = 'UNLOCKED';
            decryptBtn.style.background = 'var(--primary-blue, #c3ff00)';
            decryptBtn.style.color = '#000';
            
            document.body.classList.add('decrypted');
            
            // Hide popup naturally after success
            setTimeout(() => {
                popup.classList.add('hidden');
            }, 2000);
        } else {
            errorMsg.style.display = 'block';
            successMsg.style.display = 'none';
            
            passInput.style.transform = 'translateX(-10px)';
            setTimeout(() => passInput.style.transform = 'translateX(10px)', 100);
            setTimeout(() => passInput.style.transform = 'translateX(-10px)', 200);
            setTimeout(() => passInput.style.transform = 'translateX(10px)', 300);
            setTimeout(() => passInput.style.transform = 'translateX(0)', 400);
        }
    };

    decryptBtn.addEventListener('click', attemptDecryption);
    passInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            e.preventDefault();
            attemptDecryption();
        }
    });
});
</script>

<?php get_footer(); ?>

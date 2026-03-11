/* ============================================
   Common JS for Sub Pages
   CREATIVE GOLD
   
   スクロールアニメーション、ナビゲーションハイライト、
   サービス表示順の動的切替など
   ============================================ */

(function () {
  'use strict';

  document.addEventListener('DOMContentLoaded', () => {

    // テーマ適用（theme.jsのinitに加えて追加のロジック）
    const route = ThemeManager.getRoute();

    // ── ナビゲーション現在ページハイライト ──
    const currentPath = window.location.pathname;
    document.querySelectorAll('.sub-header-nav a').forEach(a => {
      const href = a.getAttribute('href');
      if (currentPath.includes(href.replace('index.html', '').replace('.html', ''))) {
        a.classList.add('is-current');
      }
    });

    // ── トップへ戻るリンクのルート対応 ──
    // 下層ページはサブディレクトリにあるため ../top-x.html
    const topLink = document.querySelector('.sub-header-logo');
    if (topLink && route) {
      topLink.href = `../top-${route}.html`;
    }
    const backLink = document.querySelector('.sub-footer-back');
    if (backLink && route) {
      backLink.href = `../top-${route}.html`;
    }

    // ── サービス表示順の動的切替 ──
    const serviceContainer = document.querySelector('[data-service-reorder]');
    if (serviceContainer && route) {
      const items = Array.from(serviceContainer.querySelectorAll('[data-service-id]'));
      
      // ルートごとの表示順序
      const order = {
        a: ['web-gunshi', 'creative-gold', 'creative-ghost'],
        b: ['creative-ghost', 'creative-gold', 'web-gunshi'],
        c: ['creative-gold', 'creative-ghost', 'web-gunshi'],
      };

      const sortOrder = order[route] || order.a;
      
      // ソートして再配置
      const sorted = items.sort((a, b) => {
        const aIdx = sortOrder.indexOf(a.dataset.serviceId);
        const bIdx = sortOrder.indexOf(b.dataset.serviceId);
        return aIdx - bIdx;
      });

      // 再配置（ロゴ画像はそのまま維持）
      sorted.forEach((item) => {
        serviceContainer.appendChild(item);
      });
    }

    // ── スクロールアニメーション ──
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
        }
      });
    }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

    document.querySelectorAll('.fade-in').forEach(el => observer.observe(el));

    // ── パスワードフォーム（デザイン・挙動のみ） ──
    const passwordForm = document.querySelector('.password-form');
    if (passwordForm) {
      passwordForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const input = passwordForm.querySelector('.password-input');
        const error = passwordForm.querySelector('.password-error');
        
        if (!input.value.trim()) {
          if (error) {
            error.textContent = 'パスワードを入力してください。';
            error.classList.add('is-visible');
          }
          return;
        }

        // 静的段階では常にエラー表示（CMS化後に実装）
        if (error) {
          error.textContent = 'パスワードが正しくありません。名刺に記載のパスワードをご確認ください。';
          error.classList.add('is-visible');
        }
      });
    }

  });
})();

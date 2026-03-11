/* ============================================
   Entry Page Controller
   CREATIVE GOLD
   
   アンケート選択 → ルート保存 → トランジションへ遷移
   ============================================ */

(function () {
  'use strict';

  document.addEventListener('DOMContentLoaded', () => {
    const choices = document.querySelectorAll('.entry-choice');

    choices.forEach((choice) => {
      choice.addEventListener('click', () => {
        const route = choice.dataset.route;
        if (!route) return;

        // ルートを保存
        ThemeManager.saveRoute(route);

        // クリックした選択肢にアクティブ状態を付与
        choices.forEach((c) => c.style.pointerEvents = 'none');
        choice.classList.add('is-active');

        // 少し間を置いてトランジションへ遷移
        setTimeout(() => {
          window.location.href = 'transition.html';
        }, 300);
      });
    });
  });
})();

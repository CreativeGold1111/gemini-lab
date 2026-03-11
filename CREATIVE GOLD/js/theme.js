/* ============================================
   Theme Manager
   CREATIVE GOLD
   
   localStorageからルート選択を読み取り、
   CSS変数を動的に書き換える。
   全ページの<head>内で読み込む。
   ============================================ */

const ThemeManager = (() => {
  'use strict';

  const STORAGE_KEY = 'cg_route';

  const themes = {
    a: {
      label: '誠実さ',
      primary: '#003cb9',
      primaryRgb: '0, 60, 185',
      dark: '#0A1628',
      accent: '#3366e0',
      light: '#E8EEFF',
    },
    b: {
      label: 'ユニークさ',
      primary: '#84ff00',
      primaryRgb: '132, 255, 0',
      dark: '#0A2818',
      accent: '#9aff33',
      light: '#F0FFE0',
    },
    c: {
      label: '実績',
      primary: '#E84040',
      primaryRgb: '232, 64, 64',
      dark: '#280A0A',
      accent: '#F06060',
      light: '#FFE8E6',
    },
  };

  /**
   * ルートを保存
   * @param {'a'|'b'|'c'} route
   */
  function saveRoute(route) {
    try {
      localStorage.setItem(STORAGE_KEY, route);
    } catch (e) {
      // localStorage が使えない場合はCookieにフォールバック
      document.cookie = `${STORAGE_KEY}=${route};path=/;max-age=86400;SameSite=Lax`;
    }
  }

  /**
   * ルートを読み込み
   * @returns {'a'|'b'|'c'|null}
   */
  function getRoute() {
    try {
      const stored = localStorage.getItem(STORAGE_KEY);
      if (stored && themes[stored]) return stored;
    } catch (e) {
      // Cookieから読み込み
      const match = document.cookie.match(new RegExp(`${STORAGE_KEY}=([abc])`));
      if (match) return match[1];
    }
    return null;
  }

  /**
   * CSS変数をテーマカラーで書き換え
   * @param {'a'|'b'|'c'} route
   */
  function applyTheme(route) {
    const theme = themes[route];
    if (!theme) return;

    const root = document.documentElement;
    root.style.setProperty('--theme-primary', theme.primary);
    root.style.setProperty('--theme-primary-rgb', theme.primaryRgb);
    root.style.setProperty('--theme-dark', theme.dark);
    root.style.setProperty('--theme-accent', theme.accent);
    root.style.setProperty('--theme-light', theme.light);

    // bodyにルートクラスを付与（CSS制御用）
    document.body.classList.remove('route-a', 'route-b', 'route-c');
    document.body.classList.add(`route-${route}`);
  }

  /**
   * 初期化：ルートを読み込んでテーマを適用
   */
  function init() {
    const route = getRoute();
    if (route) {
      applyTheme(route);
    }
  }

  /**
   * テーマ情報を取得
   * @param {'a'|'b'|'c'} route
   * @returns {object|null}
   */
  function getTheme(route) {
    return themes[route] || null;
  }

  return {
    saveRoute,
    getRoute,
    applyTheme,
    getTheme,
    init,
    STORAGE_KEY,
  };
})();

// DOM読み込み完了時にテーマを適用
document.addEventListener('DOMContentLoaded', ThemeManager.init);

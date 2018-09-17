import storeImporter from '../modules/importers/storeImporter';

export const modules = storeImporter(require.context('./layout', false, /.*\.js$/));

export const state = {
    home: true,
    themes: {},
    lightsOff: false,
    isMobile: false,
    isTablet: false,
    isTouch: false,
};

export const getters = {
    current: (state, commit, rootState) => {
        if (!rootState.auth.isAuth) {
            return 'auth';
        }

        return state.home
            ? 'home'
            : rootState.preferences.global.layout;
    },
};

export const mutations = {
    showHome: state => (state.home = true),
    hideHome: state => (state.home = false),
    setThemes: (state, themes) => (state.themes = themes),
    setThemeParams() {
        const height = document.querySelector('.app-navbar').clientHeight;
        const menuAside = document.querySelector('.menu.aside');
        const settingsAside = document.querySelector('.settings.aside');
        const mainContent = document.querySelector('section.main-content');

        if (menuAside) {
            menuAside.style.top = `${height}px`;
        }

        if (settingsAside) {
            settingsAside.style.top = `${height}px`;
        }

        mainContent.style['margin-top'] = `${height}px`;
    },
    toggleLights(state) {
        state.lightsOff = !state.lightsOff;
    },
    setIsMobile: (state, isMobile) => (state.isMobile = isMobile),
    setIsTablet: (state, isTablet) => (state.isTablet = isTablet),
    setIsTouch: (state, isTouch) => (state.isTouch = isTouch),
};

export const actions = {
    setTheme({ state, rootGetters }, theme = null) {
        document.getElementById('theme')
            .setAttribute('href', theme || state.themes[rootGetters['preferences/theme']]);

        if (!theme) {
            localStorage.setItem('theme', state.themes[rootGetters['preferences/theme']]);
        }
    },
    setInitialTheme({ dispatch }) {
        const theme = localStorage.getItem('theme');

        if (theme) {
            dispatch('setTheme', theme);
        }
    },
    switchTheme({ commit, dispatch }) {
        commit('toggleLights');
        setTimeout(() => {
            dispatch('setTheme').then(() => {
                setTimeout(() => {
                    commit('toggleLights');
                    setTimeout(() => commit('setThemeParams'), 501);
                }, 1000);
            });
        }, 500);
    },
};

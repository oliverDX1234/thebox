export const state = {
  layoutType: window.Laravel.user ? window.Laravel.user.admin_settings.layout.type : 'vertical',
  layoutWidth: window.Laravel.user ? window.Laravel.user.admin_settings.layout.width : 'fluid',
  leftSidebarType: window.Laravel.user ? window.Laravel.user.admin_settings.layout.sidebartype : 'dark',
  loaded: window.Laravel.user ? window.Laravel.viewIsLoaded : false,
  topbar: window.Laravel.user ? window.Laravel.user.admin_settings.layout.topbar : 'dark',
  loader: window.Laravel.user ? window.Laravel.user.admin_settings.layout.loader : false,
}

export const getters = {}

export const mutations = {
  CHANGE_LAYOUT(state, layoutType) {
    state.layoutType = layoutType;
  },
  CHANGE_LAYOUT_WIDTH(state, layoutWidth) {
    state.layoutWidth = layoutWidth;
  },
  CHANGE_LEFT_SIDEBAR_TYPE(state, leftSidebarType) {
    state.leftSidebarType = leftSidebarType;
  },
  CHANGE_TOPBAR(state, topbar) {
    state.topbar = topbar;
  },
  LOADER(state, loader) {
    state.loader = loader
  }
}

export const actions = {
  changeLayoutType({ commit }, { layoutType }) {
    commit('CHANGE_LAYOUT', layoutType);
  },

  changeLayoutWidth({ commit }, { layoutWidth }) {
    commit('CHANGE_LAYOUT_WIDTH', layoutWidth)
  },

  changeLeftSidebarType({ commit }, { leftSidebarType }) {
    commit('CHANGE_LEFT_SIDEBAR_TYPE', leftSidebarType)
  },

  changeTopbar({ commit }, { topbar }) {
    commit('CHANGE_TOPBAR', topbar)
  },

  changeLoaderValue({ commit }, { loader }) {
    commit('LOADER', loader)
  }
}

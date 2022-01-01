export const state = {
  layoutType: 'vertical',
  layoutWidth: 'fluid',
  leftSidebarType: 'dark',
  topbar: 'dark',
  loader: false
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
  LOAD_LAYOUT(state, layout) {
    state.layoutType = layout.type;
    state.layoutWidth = layout.width;
    state.leftSidebarType = layout.sidebartype;
    state.topbar = layout.topbar;
    state.loader = layout.loader;
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

import {mapState, mapActions, mapGetters} from 'vuex'

export const layoutComputed = {
  ...mapState('layout', {
    layoutType: (state) => state.layoutType,
    leftSidebarType: (state) => state.leftSidebarType,
    layoutWidth: (state) => state.layoutWidth,
    topbar: (state) => state.topbar,
    loader: (state) => state.loader,
    loaded: (state) => state.loaded
  })
}

export const authMethods = mapActions('auth', ['login', 'logout'])

export const layoutMethods = mapActions('layout', ['changeLayoutType', 'changeLayoutWidth', 'changeLeftSidebarType', 'changeTopbar', 'changeLoaderValue'])

export const notificationMethods = mapActions('notification', ['success', 'error', 'clear'])

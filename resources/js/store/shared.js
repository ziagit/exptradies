export default {
  namespaced: true,
  state: {
    room: null,
    chat: null,
    notification: null,
  },
  getters: {
    room(state) {
      return state.room;
    },
    chat(state) {
      return state.chat;
    },
    notification(state) {
      return state.notification;
    },
  },

  mutations: {
    SET_ROOM(state, data) {
      state.room = data;
    },
    SET_CHAT(state, data) {
      state.chat = data;
    },
    SET_NOTIFICATION(state, data) {
      state.notification = data;
    },
  },
  actions: {
    room({ dispatch }, data) {
      return dispatch("attempt", data);
    },
    async attempt({ commit, state }, data) {
      if (data) {
        commit("SET_ROOM", data);
      }
      if (!state.room) {
        return;
      }
    },
    chat({ dispatch }, data) {
      return dispatch("attempt2", data);
    },
    async attempt2({ commit, state }, data) {
      if (data) {
        commit("SET_CHAT", data);
      }
      if (!state.chat) {
        return;
      }
    },
    notification({ dispatch }, data) {
      return dispatch("attempt3", data);
    },
    async attempt3({ commit, state }, data) {
      if (data) {
        commit("SET_NOTIFICATION", data);
      }
      if (!state.notification) {
        return;
      }
    },
    clean({ commit }) {
      commit("SET_CHAT", null);
      commit("SET_ROOM", null);
      commit("SET_NOTIFICATION", null);
    },
    removeRome({ commit }) {
      commit("SET_ROOM", null);
    },
  },
};

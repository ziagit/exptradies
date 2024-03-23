export default {
    namespaced: true,
    state: {
        post: [],
    },
    getters: {
        post(state) {
            return state.post;
        }
    },

    mutations: {
        PUSH_TO_POST(state, data) {
            state.post.push(data);
        },
        POP_FROM_POST(state, data){
            
        },
        CLEAR_POST(state, data) {
            state.post=[];
        }
    },

    actions: {
        push(context, data) {
            context.commit("PUSH_TO_POST", data);
        },
        pop(context, data) {
            context.commit("POP_FROM_POST", data);
        },
        clear(context, data) {
            context.commit("CLEAR_POST", null);
        }
    }
};

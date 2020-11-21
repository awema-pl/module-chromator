import types from './mutation-types';

export default {

    [types.INCREMENT_COUNTER](state) {
        state.counter = state.counter || 0
        state.counter++;
    },
};

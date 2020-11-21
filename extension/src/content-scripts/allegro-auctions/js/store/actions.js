import types from './mutation-types';

export default{
    incrementCounter: ({ state, commit, rootState, rootGetters  }) =>  {
        commit(types.INCREMENT_COUNTER)
    }
}

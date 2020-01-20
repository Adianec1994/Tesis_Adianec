import axios from 'axios'

// state
export const state = {
  disponibilidades: [],
  proveedores: [],
  provincias: [],
  entidades: [],
  hechos_extraordinarios: [],
  planes: [],
  centrales_electricas: [],
  baterias: [],
  coberturas_combustibles: [],
  datos_generales: [],
  operadores: [],
  pailas: [],
  grupos: [],
  eventos_diarios: [],
  generaciones: [],
  usuarios: [],
  trazas: [],
  mantenedores_externos: [],
  mantenimientos: [],
  brigadas: [],
  roles: []
}

// mutations
export const mutations = {
  FETCH: (state, {
    payload,
    moduleName
  }) => {
    state[moduleName] = payload
  },
  ADD: (state, {
    payload,
    moduleName
  }) => {
    state[moduleName].push(payload)
  },
  UPDATE: (state, {
    payload,
    moduleName
  }) => {
    const payloadIndex = state[moduleName].findIndex(pr => pr.id === payload.id)
    state[moduleName].splice(payloadIndex, 1, payload)
  },
  DELETE: (state, {
    payload,
    moduleName
  }) => {
    const payloadIndex = state[moduleName].findIndex(pr => pr.id == payload)
    state[moduleName].splice(payloadIndex, 1)
  }
}

// actions
export const actions = {
  GET: ({
    commit
  }, moduleName) => {
    return axios.get(`/api/${moduleName}`).then(response => {
      commit('FETCH', {
        payload: response.data.data,
        moduleName
      })
      return response.data
    })
  },
  SAVE: ({
    commit
  }, {
    payload,
    moduleName
  }) => {
    return axios.post(`/api/${moduleName}`, payload).then(response => {
      commit('ADD', {
        payload: response.data.data,
        moduleName
      })
      return response.data
    })
  },
  EDIT: ({
    commit
  }, {
    payload,
    moduleName
  }) => {
    return axios.put(`/api/${moduleName}/${payload.id}`, payload).then(response => {
      commit('UPDATE', {
        payload: response.data.data,
        moduleName
      })
      return response.data
    })
  },
  DESTROY: ({
    commit
  }, {
    payload,
    moduleName
  }) => {
    return axios.delete(`/api/${moduleName}/${payload.id}`).then(response => {
      commit('DELETE', {
        payload: response.data.data,
        moduleName
      })
      return response.data
    })
  }
}

// getters
export const getters = {
  get: (state) => (moduleName) => {
    return state[moduleName]
  }
}

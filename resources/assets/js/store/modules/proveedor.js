import axios from 'axios'

const apiUrl = process.env.APP_URL

// state
export const state = {
  proveedores: []
}

// mutations
export const mutations = {
  FETCH_PROVEEDORES: (state, proveedores) => {
    state.proveedores = proveedores
  },
  ADD_PROVEEDOR: (state, proveedor) => {
    state.proveedor.push(proveedor)
  }
}

// actions
export const actions = {
  GET_PROVEEDORES: ({
    commit
  }) => {
    return axios.get(`/api/proveedor`).then(response => {
      commit('FETCH_PROVEEDORES', response.data.data)
    })
  },
  SAVE_PROVEEDOR: ({
    commit
  }, proveedor) => {
    axios.post(`${apiUrl}/proveedor/create`, proveedor).then(response => {
      commit('ADD_PROVEEDOR', proveedor)
    })
  }
}

export const getters = {
  getProveedores: state => {
    return state.proveedores
  }
}

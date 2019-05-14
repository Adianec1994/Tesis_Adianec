import axios from 'axios'

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
    state.proveedores.push(proveedor)
  },
  UPDATE_PROVEEDOR: (state, proveedor) => {
    const proveedorIndex = state.proveedores.findIndex(pr => pr.id === proveedor.id)
    state.proveedores.splice(proveedorIndex, 1, proveedor)
  },
  DELETE_PROVEEDOR: (state, proveedor) => {
    const proveedorIndex = state.proveedores.findIndex(pr => pr.id === proveedor.id)
    state.proveedores.splice(proveedorIndex, 1)
  }
}

// actions
export const actions = {
  GET_PROVEEDORES: ({
    commit
  }) => {
    return axios.get(`/api/proveedor`).then(response => {
      commit('FETCH_PROVEEDORES', response.data.data)
      return response.data
    })
  },
  SAVE_PROVEEDOR: ({
    commit
  }, proveedor) => {
    return axios.post(`/api/proveedor`, proveedor).then(response => {
      commit('ADD_PROVEEDOR', proveedor)
      return response.data
    })
  },
  EDIT_PROVEEDOR: ({
    commit
  }, proveedor) => {
    return axios.put(`/api/proveedor/${proveedor.id}`, proveedor).then(response => {
      commit('UPDATE_PROVEEDOR', response.data.data)
      return response.data
    })
  },
  DESTROY_PROVEEDOR: ({
    commit
  }, proveedor) => {
    return axios.delete(`/api/proveedor/${proveedor.id}`).then(response => {
      commit('DELETE_PROVEEDOR', proveedor)
      return response.data
    })
  }
}

// getters
export const getters = {
  getProveedores: state => {
    return state.proveedores
  }
}

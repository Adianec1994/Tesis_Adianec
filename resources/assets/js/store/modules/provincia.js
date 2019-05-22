import axios from 'axios'

// state
export const state = {
  provincias: []
}

// mutations
export const mutations = {
  FETCH_PROVINCIAS: (state, provincias) => {
    state.provincias = provincias
  },
  ADD_PROVINCIA: (state, provincia) => {
    state.provincias.push(provincia)
  },
  UPDATE_PROVINCIA: (state, provincia) => {
    const provinciaIndex = state.provincias.findIndex(pr => pr.id === provincia.id)
    state.provincias.splice(provinciaIndex, 1, provincia)
  },
  DELETE_PROVINCIA: (state, provincia) => {
    const provinciaIndex = state.provincias.findIndex(pr => pr.id === provincia.id)
    state.provincias.splice(provinciaIndex, 1)
  }
}

// actions
export const actions = {
  GET_PROVINCIAS: ({
    commit
  }) => {
    return axios.get(`/api/provincia`).then(response => {
      commit('FETCH_PROVINCIAS', response.data.data)
      return response.data
    })
  },
  SAVE_PROVINCIA: ({
    commit
  }, provincia) => {
    return axios.post(`/api/provincia`, provincia).then(response => {
      commit('ADD_PROVINCIA', response.data.data)
      return response.data
    })
  },
  EDIT_PROVINCIA: ({
    commit
  }, provincia) => {
    return axios.put(`/api/provincia/${provincia.id}`, provincia).then(response => {
      commit('UPDATE_PROVINCIA', response.data.data)
      return response.data
    })
  },
  DESTROY_PROVINCIA: ({
    commit
  }, provincia) => {
    return axios.delete(`/api/provincia/${provincia.id}`).then(response => {
      commit('DELETE_PROVINCIA', response.data.data)
      return response.data
    })
  }
}

// getters
export const getters = {
  getProvincias: state => {
    return state.provincias
  }
}

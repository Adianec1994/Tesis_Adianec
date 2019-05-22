import axios from 'axios'

// state
export const state = {
  disponibilidades: []
}

// mutations
export const mutations = {
  FETCH_DISPONIBILIDADES: (state, disponibilidades) => {
    state.disponibilidades = disponibilidades
  },
  ADD_DISPONIBILIDAD: (state, disponibilidad) => {
    state.disponibilidades.push(disponibilidad)
  },
  UPDATE_DISPONIBILIDAD: (state, disponibilidad) => {
    const disponibilidadIndex = state.disponibilidades.findIndex(pr => pr.id === disponibilidad.id)
    state.disponibilidades.splice(disponibilidadIndex, 1, disponibilidad)
  },
  DELETE_DISPONIBILIDAD: (state, disponibilidad) => {
    const disponibilidadIndex = state.disponibilidades.findIndex(pr => pr.id === disponibilidad.id)
    state.disponibilidades.splice(disponibilidadIndex, 1)
  }
}

// actions
export const actions = {
  GET_DISPONIBILIDADES: ({
    commit
  }) => {
    return axios.get(`/api/disponibilidad`).then(response => {
      commit('FETCH_DISPONIBILIDADES', response.data.data)
      return response.data
    })
  },
  SAVE_DISPONIBILIDAD: ({
    commit
  }, disponibilidad) => {
    return axios.post(`/api/disponibilidad`, disponibilidad).then(response => {
      commit('ADD_DISPONIBILIDAD', response.data.data)
      return response.data
    })
  },
  EDIT_DISPONIBILIDAD: ({
    commit
  }, disponibilidad) => {
    return axios.put(`/api/disponibilidad/${disponibilidad.id}`, disponibilidad).then(response => {
      commit('UPDATE_DISPONIBILIDAD', response.data.data)
      return response.data
    })
  },
  DESTROY_DISPONIBILIDAD: ({
    commit
  }, disponibilidad) => {
    return axios.delete(`/api/disponibilidad/${disponibilidad.id}`).then(response => {
      commit('DELETE_DISPONIBILIDAD', response.data.data)
      return response.data
    })
  }
}

// getters
export const getters = {
  getDisponibilidades: state => {
    return state.disponibilidades
  }
}

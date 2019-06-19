export default ({ authGuard, guestGuard }) => [
  { path: '/', name: 'welcome', component: require('~/pages/welcome.vue') },

  // Authenticated routes.
  ...authGuard([
    { path: '/home', name: 'home', component: require('~/pages/home.vue') },
    { path: '/settings',
      component: require('~/pages/settings/index.vue'),
      children: [
      { path: '', redirect: { name: 'settings.profile' }},
      { path: 'profile', name: 'settings.profile', component: require('~/pages/settings/profile.vue') },
      { path: 'password', name: 'settings.password', component: require('~/pages/settings/password.vue') }
      ] },

    // rutas de datos generales
    { path: '/datos_generales', name: 'datos_generales', component: require('~/pages/entities/datos_generales.vue') },
    { path: '/provincias', name: 'provincias', component: require('~/pages/nomenclators/provincias.vue') },
    { path: '/entidades', name: 'entidades', component: require('~/pages/entities/entidades.vue') },
    { path: '/centrales_electricas', name: 'centrales_electricas', component: require('~/pages/entities/centrales_electricas.vue') },
    { path: '/baterias', name: 'baterias', component: require('~/pages/entities/baterias.vue') },
    { path: '/grupos', name: 'grupos', component: require('~/pages/entities/grupos.vue') },
    { path: '/proveedores', name: 'proveedores', component: require('~/pages/nomenclators/proveedores.vue') },
    { path: '/usuarios', name: 'usuarios', component: require('~/pages/nomenclators/usuarios.vue') },
    { path: '/mantenedores_externos', name: 'mantenedores_externos', component: require('~/pages/nomenclators/mantenedores_externos.vue') },

    // rutas de combustible
    { path: '/generaciones', name: 'generaciones', component: require('~/pages/entities/generaciones.vue') },
    { path: '/pailas', name: 'pailas', component: require('~/pages/nomenclators/pailas.vue') },
    { path: '/coberturas_combustibles', name: 'coberturas_combustibles', component: require('~/pages/entities/coberturas_combustibles.vue') },

    // rutas de producción
    { path: '/planes', name: 'planes', component: require('~/pages/entities/planes.vue') },
    { path: '/disponibilidades', name: 'disponibilidades', component: require('~/pages/nomenclators/disponibilidades.vue') },
    { path: '/hechos_extraordinarios', name: 'hechos_extraordinarios', component: require('~/pages/entities/hechos_extraordinarios.vue') },

    // rutas de administración
    { path: '/trazas', name: 'trazas', component: require('~/pages/nomenclators/trazas.vue') },

    { path: '/operadores', name: 'operadores', component: require('~/pages/nomenclators/operadores.vue') },
    { path: '/eventos_diarios', name: 'eventos_diarios', component: require('~/pages/entities/eventos_diarios.vue') }
  ]),

  // Guest routes.
  ...guestGuard([
    { path: '/login', name: 'login', component: require('~/pages/auth/login.vue') },
    { path: '/register', name: 'register', component: require('~/pages/auth/register.vue') },
    { path: '/password/reset', name: 'password.request', component: require('~/pages/auth/password/email.vue') },
    { path: '/password/reset/:token', name: 'password.reset', component: require('~/pages/auth/password/reset.vue') }
  ]),

  { path: '*', component: require('~/pages/errors/404.vue') }
]

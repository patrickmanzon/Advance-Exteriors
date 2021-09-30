
const routes = [
  {
    path: '/',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      { path: '', component: () => import('pages/Index.vue') },
      { path: 'users', component: () => import('pages/users/Index.vue') },
      { path: 'albums', component: () => import('pages/albums/Index.vue') },
      { path: 'photos', component: () => import('pages/photos/Index.vue') },
      { path: 'users/:id/albums', name:'user-albums' ,component: () => import('pages/user-albums/Index.vue') },
      { path: 'albums/:id/photos', name:'album-photos', component: () => import('pages/album-photos/Index.vue') }
    ]
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: '*',
    component: () => import('pages/Error404.vue')
  }
]

export default routes

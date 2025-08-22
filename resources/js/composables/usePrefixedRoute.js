import { usePage, router } from '@inertiajs/vue3'


export function usePrefixedRoute() {
  const page = usePage()
  const prefix = page.props.prefix || '' // admin|barbeiro|cliente

  // routeP('dashboard') => admin.dashboard / barbeiro.dashboard / cliente.dashboard
  const routeP = (name, params = {}, absolute = false, config = undefined) => {
    if (!prefix) return route(name, params, absolute, config) // fallback
    const prefixed = `${prefix}.${name}`
    return route(prefixed, params, absolute, config)
  }

  return { routeP, prefix }
}

export function usePrefixPath() {
  const prefix = (usePage().props.prefix || '').toString() // 'admin' | 'barbeiro' | 'cliente'

  // monta um path com o prefixo: path('dashboard') => '/admin/dashboard'
  const path = (segment = '') => {
    const seg = segment.startsWith('/') ? segment.slice(1) : segment
    return `/${prefix}/${seg}`.replace(/\/+$/, '') // tira barra final se vazia
  }

  // atalhos comuns (opcional)
  const goto = (segment, options = {}) => router.visit(path(segment), options)
  const post = (segment, data, options = {}) => router.post(path(segment), data, options)
  const put  = (segment, data, options = {}) => router.put(path(segment), data, options)
  const del  = (segment, data = {}, options = {}) => router.delete(path(segment), { data, ...options })

  return { prefix, path, goto, post, put, del }
}

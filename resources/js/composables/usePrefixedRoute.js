import { usePage } from '@inertiajs/vue3'
import route from 'ziggy-js'

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

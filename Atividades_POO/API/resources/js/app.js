import './bootstrap';
import Alpine from 'alpinejs'


window.Alpine = Alpine
Alpine.start()


if (import.meta.env.DEV) {
  window.Alpine = Alpine
  console.log('Alpine.js carregado', Alpine.version)
}
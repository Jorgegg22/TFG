import { inject } from '@angular/core';
import { CanActivateFn, Router } from '@angular/router';

export const authRoleGuard: CanActivateFn = (route, state) => {
  const router = inject(Router);

  const sesionStr = localStorage.getItem('sesion');
  //Convertimos en objeto sesionStr,para acceder al token
  const sesionObj = JSON.parse(sesionStr || '{}');
  const userRole = sesionObj.rol;

  // Extraemos el array de roles que definiste en el routing
  const expectedRoles = route.data['expectedRoles'] as Array<string>;

  // Comprobamos si el rol del usuario existe y está incluido en los permitidos
  if (userRole && expectedRoles.includes(userRole)) {
    return true;
  }

  // Si no tiene el rol necesario, al login
  router.navigate(['/login']);
  return false;
};

import { inject } from '@angular/core';
import { CanActivateFn, Router } from '@angular/router';

export const authRoleGuard: CanActivateFn = (route, state) => {
  const router = inject(Router);

  const sesionStr = localStorage.getItem('sesion');
  //SESION OBJETO
  const sesionObj = JSON.parse(sesionStr || '{}');
  const userRole = sesionObj.rol;

  // RUTA DE ROLES
  const expectedRoles = route.data['expectedRoles'] as Array<string>;

 // COMPROBAMOS ROL
  if (userRole && expectedRoles.includes(userRole)) {
    return true;
  }
 
  router.navigate(['/login']);
  return false;
};

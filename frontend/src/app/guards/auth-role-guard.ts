import { inject } from '@angular/core';
import { CanActivateFn, Router } from '@angular/router';

export const authRoleGuard: CanActivateFn = (route, state) => {
  const router = inject(Router);
  

  const userRole = localStorage.getItem('role'); 

  
  const expectedRole = route.data['expectedRole'];

  if (userRole === expectedRole) {
    return true;
  }

  // Si no es el rol correcto, lo mandamos al login
  router.navigate(['/login']);
  return false;
};

export interface Usuario {
  id: number;
  nombre: string;
  email: string;
  rol: 'admin' | 'estudiante' | 'propietario';
  universidad_id?: number;
  created_at?: string;
  nombre_universidad?: string; 
}
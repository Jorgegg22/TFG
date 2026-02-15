export interface Notificacion {
  id: string;
  estudiante_id: string;
  inmueble_id: string;
  estado: 'aceptado' | 'rechazado';
  fecha_solicitud: string;
  nombre_inmueble: string; 
 
}
export interface Inmueble {
  id: number;
  titulo: string;
  descripcion: string;
  direccion: string | null;
  precio: number;
  imagen_principal: string | null;
  propietario_id: number;
  created_at: string;
  universidad_id: number;
  nombre_propietario: string;
  nombre_universidad: string;
  metros: number;
  habitaciones: number;
  banios: number;
  n_personas: number;
}
export interface Inmueble {
  id: number;
  titulo: string;
  descripcion: string;
  direccion: string | null;
  precio: number;
  imagen_principal: string | null;
  imagen1:string | null;
  imagen2:string | null;
  imagen3:string | null;
  imagen4:string | null;
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
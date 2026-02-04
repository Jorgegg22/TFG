export interface InmuebleAleatorio {
  id: string;
  titulo: string;
  descripcion: string;
  direccion: string | null;
  precio: string;
  imagen_principal: string | null;
  propietario_id: string;
  created_at: string;
  universidad_id: string;
  nombre_propietario: string;
  nombre_universidad: string;
  estudiante_id: string | null;
  nombre_estudiante: string | null;
  foto_perfil: string | null;
}
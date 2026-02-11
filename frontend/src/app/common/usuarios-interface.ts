export interface Usuario {
  status: string;
  mensaje: string;
  data: UserData;
}

export interface UserData {
  id: string;
  nombre: string;
  email: string;
  rol: 'estudiante' | 'propietario';
  atributos_usuario: string;
  created_at: string;
  token_expira: string;
  descripcion: string | null;
  foto_perfil: string | null;
  telefono: string | null;
  id_carrera: string | null;
  nombre_carrera: string | null;
  universidad_id: string | null;
  nombre_universidad: string | null;
  link_instagram: string;
  link_spotify: string;
  link_x: string;
}
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
  atributos_usuario: string; // Formato: "Nombre|icono;Nombre|icono"
  created_at: string;
  token_expira: string;
  
  // Campos opcionales (vienen como null inicialmente)
  descripcion: string | null;
  foto_perfil: string | null;
  telefono: string | null;
  id_carrera: string | null;
  nombre_carrera: string | null;
  universidad_id: string | null;
  nombre_universidad: string | null;
  
  // Redes sociales
  link_instagram: string;
  link_spotify: string;
  link_x: string;
}
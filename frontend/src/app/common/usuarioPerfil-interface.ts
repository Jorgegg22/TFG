
export interface UsuarioPerfil {
  id: string;
  nombre: string;
  email: string;
  telefono: string;
  descripcion: string;
  rol: string;        
  password?: string;     
  created_at: string;
  id_carrera: string;
  nombre_carrera: string;
  universidad_id: string;
  nombre_universidad: string;
}

export interface DataPerfil {
  perfil: UsuarioPerfil;
}


export interface InfoPerfil {
  status: string;       
  mensaje: string;  
  data: DataPerfil;
}
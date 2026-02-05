export interface InfoPerfil {
    status: string;
    mensaje: string;
    data: DataPerfil;
}

export interface DataPerfil {
    perfil: UsuarioPerfil;
}

export interface UsuarioPerfil {
    id: string;
    nombre: string;
    email: string;
    telefono: string;
    descripcion: string;
    id_carrera: string;
    password: string;
    rol: string;
    created_at: string;
    universidad_id: string;
}
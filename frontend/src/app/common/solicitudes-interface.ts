export interface Solicitud {
    status: string;
    mensaje: string;
    data: Data;
}

export interface Data {
    inmuebles: Inmueble[];
}

export interface Inmueble {
    id: string;
    nombre: string;
    email: string;
    telefono: string;
    descripcion: string;
    id_carrera: string;
    password: string;
    rol: string;
    universidad_id: string;
    titulo: string;
    direccion: string;
    precio: string;
    imagen_principal: null | any; 
    propietario_id: string;
    estudiante_id: string;
    inmueble_id: string;
    estado_solicitud: string;
    mensaje_presentacion: string;
    fecha_solicitud: string;
    fecha_respuesta: null | string; 
}
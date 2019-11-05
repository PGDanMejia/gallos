use industria;
DROP PROCEDURE IF EXISTS sp_empleados;
DELIMITER //
create procedure sp_empleados(
	in p_accion int,
	in p_id_usuario int,
	in p_estado int,
	in p_tipoUsuario int,
    in p_nombre varchar(60),
    in p_apellido varchar(60),
    in p_correo varchar(60),
    in p_contrasenia varchar(60),
    in p_genero varchar(60),
    in p_fecha_nacimiento date,
    in p_fecha_registro date,
    in p_fecha_modificado date,
    in p_urlImagen varchar(100)
) 
begin
	if p_accion=1 then
    -- Se agrega nuevo usuario
		INSERT INTO usuario (
			idEstado,
			idTipoUsuario,
			nombre,
			apellido,
			correoInstitucional,
			contrasenia,
			genero,
			fechaNacimiento,
			fechaRegistro
            )
	VALUES (
			p_estado,
			p_tipoUsuario,
			p_nombre,
			p_apellido,
			p_correo,
			p_contrasenia,
			p_genero,
			p_fecha_nacimiento,
			sysdate()
            );
           SELECT LAST_INSERT_ID();
    ELSEIF p_accion=2 THEN
		-- Modificar Estado
		IF p_estado IS NOT NULL THEN
			UPDATE usuario
			SET idEstado = p_estado
			WHERE (idUsuario=p_id_usuario); 
        END IF;
	  -- Modificar Tipo Usuario
        IF p_tipoUsuario IS NOT NULL THEN
			UPDATE usuario
			SET idTipoUsuario = p_tipoUsuario
			WHERE (idUsuario=p_id_usuario); 
        END IF;
	  -- Modificar Nombre
		IF p_nombre IS NOT NULL THEN
			UPDATE usuario
			SET nombre = p_nombre
			WHERE (idUsuario=p_id_usuario); 
        END IF;
      -- Modificar Apellido
		IF p_apellido IS NOT NULL THEN
			UPDATE usuario
			SET apellido = p_apellido
			WHERE (idUsuario=p_id_usuario); 
        END IF;
      -- Modificar Correo
		IF p_correo IS NOT NULL THEN
			UPDATE usuario
			SET correoInstitucional = p_correo
			WHERE (idUsuario=p_id_usuario); 
        END IF;
      
      -- Modificar Contrasenia
		IF p_contrasenia IS NOT NULL THEN
			UPDATE usuario
			SET contrasenia = p_contrasenia
			WHERE (idUsuario=p_id_usuario); 
        END IF;
      -- Modificar Genero
      IF p_genero IS NOT NULL THEN
			UPDATE usuario
			SET genero = p_genero
			WHERE (idUsuario=p_id_usuario); 
        END IF;
      -- Modificar Fecha Nacimiento
		IF p_fecha_nacimiento IS NOT NULL THEN
			UPDATE usuario
			SET fechaNacimiento = p_fecha_nacimiento
			WHERE (idUsuario=p_id_usuario); 
        END IF;
      -- Modificar Fecha Registro
      IF p_fecha_registro IS NOT NULL THEN
			UPDATE usuario
			SET fechaRegistro = p_fecha_registro
			WHERE (idUsuario=p_id_usuario); 
        END IF;
      -- Modificar Fecha Modificado
		UPDATE usuario
		SET fechaModificado = sysdate()
		WHERE (idUsuario=p_id_usuario); 
	-- Modificar URL Imagen
		UPDATE usuario
		SET urlImagen = p_urlImagen
		WHERE (idUsuario=p_id_usuario); 
        
		
    ELSEIF p_accion=3 then
    -- Se elimina usuario
        DELETE FROM usuario
		WHERE(idUsuario=p_id_usuario);
    ELSE 
		SELECT 'Error,No es una accion definida';
	END IF;
	 
END //
DELIMITER ; 
 



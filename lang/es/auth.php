<?php

declare(strict_types=1);

/**
 * Caller: Themes/Sixteen/resources/views/pages/auth/logout.blade.php
 * (__('pub_theme::auth.logout.*')) e User (login.blade.php: `auth.login.*`).
 *
 * Catálogo completo y autónomo: antes heredaba todo `en/auth.php` con `array_replace_recursive` y solo traducía
 * `logout`, así que login, registro, perfil y el resto salían en inglés sin ningún error.
 * Sin `$base = require`: una clave que falte aquí debe verse en el test de paridad, no esconderse bajo el inglés.
 *
 * @see docs/contracts/i18n-catalog-parity.md
 */
return [
    'login' => [
        'title' => 'Accede a tu cuenta',
        'description' => 'Introduce tus credenciales para acceder a :service',
        'no_account' => '¿Aún no tienes una cuenta?',
        'create_account' => 'Regístrate',
        'security_title' => 'Conexión segura',
        'security_message' => 'Tus datos están protegidos con cifrado SSL',
        'accessibility_info' => 'Este servicio es accesible conforme a las pautas WCAG 2.1 AA.',
        'accessibility_declaration' => 'Declaración de accesibilidad',
        'keyboard_navigation' => 'Usa la tecla Tab para moverte entre los campos y Intro para enviar el formulario.',
        'or' => 'o',
        'email' => 'Correo electrónico',
        'email_placeholder' => 'name@example.com',
        'password' => 'Contraseña',
        'password_placeholder' => 'Introduce tu contraseña',
        'remember_me' => 'Recuérdame',
        'forgot_password' => '¿Has olvidado tu contraseña?',
        'forgot_password_action' => 'Solicitar el restablecimiento de la contraseña',
        'submit' => 'Acceder',
        'help' => '¿Necesitas ayuda?',
        'main_label' => 'Formularios de acceso',
        'link' => 'Acceder',
        'success' => 'Acceso correcto',
        'error' => 'Error de acceso',
        'error_message' => 'Se ha producido un error durante el acceso. Inténtalo de nuevo más tarde.',
        'validation_error' => 'Error de validación',
        'invalid_credentials' => 'Las credenciales introducidas no son correctas.',
    ],
    'register' => [
        'title' => 'Registro',
        'description' => 'Crea tu cuenta para acceder a los servicios',
        'name' => 'Nombre completo',
        'email' => 'Correo electrónico',
        'password' => 'Contraseña',
        'password_confirmation' => 'Confirmar contraseña',
        'submit' => 'Registrarse',
        'already_registered' => '¿Ya tienes una cuenta?',
        'login' => 'Acceder',
        'link' => 'Registrarse',
    ],
    'failed' => 'Estas credenciales no coinciden con nuestros registros.',
    'password' => 'La contraseña proporcionada no es correcta.',
    'throttle' => 'Demasiados intentos de acceso. Inténtalo de nuevo en :seconds segundos.',
    'general_error' => 'Se ha producido un error. Inténtalo de nuevo más tarde.',
    'unauthorized' => 'No tienes los permisos necesarios para esta operación.',

    // Cierre de sesión
    'logout' => [
        'title' => 'Cerrar sesión',
        'confirm_message' => '¿Seguro que quieres cerrar la sesión?',
        'confirm_button' => 'Confirmar cierre de sesión',
        'cancel_button' => 'Cancelar',
        'success_title' => 'Sesión cerrada',
        'success_message' => 'Has cerrado la sesión correctamente.',
        'error_title' => 'Error al cerrar sesión',
        'error_message' => 'Se ha producido un error al cerrar la sesión.',
        'try_again' => 'Reintentar',
        'back_to_home' => 'Volver al inicio',
    ],

    // Perfil
    'profile' => [
        'title' => 'Perfil',
        'settings' => 'Ajustes',
        'information' => 'Información del perfil',
        'update_password' => 'Actualizar contraseña',
        'current_password' => 'Contraseña actual',
        'new_password' => 'Nueva contraseña',
        'confirm_password' => 'Confirmar contraseña',
        'save' => 'Guardar',
        'update' => 'Actualizar',
    ],

    // Restablecer contraseña
    'reset' => [
        'title' => 'Restablecer contraseña',
        'email' => 'Correo electrónico',
        'password' => 'Nueva contraseña',
        'password_confirmation' => 'Confirmar contraseña',
        'submit' => 'Restablecer contraseña',
        'link_sent' => '¡Te hemos enviado por correo el enlace para restablecer la contraseña!',
        'reset_link' => 'Restablecer contraseña',
    ],

    // Verificar el correo electrónico
    'verify' => [
        'title' => 'Verificar el correo electrónico',
        'message' => '¡Gracias por registrarte! Antes de empezar, ¿puedes verificar tu dirección de correo electrónico haciendo clic en el enlace que acabamos de enviarte?',
        'resend' => 'Si no has recibido el correo, podemos enviarte otro.',
        'submit' => 'Reenviar el correo de verificación',
    ],

    // Navegación
    'navigation' => [
        'open_menu' => 'Abrir el menú principal',
        'close_menu' => 'Cerrar el menú principal',
        'home' => 'Inicio',
        'dashboard' => 'Panel',
        'profile' => 'Perfil',
        'settings' => 'Ajustes',
    ],

    // Menú de usuario
    'user_dropdown' => [
        'manage_account' => 'Gestionar la cuenta',
        'profile' => 'Perfil',
        'settings' => 'Ajustes',
        'logout' => 'Cerrar sesión',
        'login_link' => 'Acceder',
        'register_link' => 'Registrarse',
    ],

    // Mensajes de notificación
    'notifications' => [
        'login_success' => 'Acceso correcto',
        'login_error' => 'Error de acceso',
        'logout_success' => 'Sesión cerrada',
        'logout_error' => 'Error al cerrar sesión',
        'validation_error' => 'Error de validación',
        'general_error' => 'Se ha producido un error. Inténtalo de nuevo más tarde.',
    ],
];

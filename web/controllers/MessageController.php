<?php

class MessageController
{


    function showMessageVerify($type, $message)
    {
        if (isset($_GET[$type]) && $_GET[$type] == 'correcto') {
            echo "
            <div class='alert alert-success w-75 mx-auto text-center' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
                $message
            </div>";
        }
    }
    
    
    // Función para mostrar mensajes de error
    function show_messages_error($type, $message)
    {
        if (isset($_GET[$type]) && $_GET[$type] == 'error') {
            echo "
            <div class='alert alert-danger w-75 mx-auto text-center' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
                $message
            </div>";
        }
    }
}

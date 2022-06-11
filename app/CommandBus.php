<?php

namespace App;

use Illuminate\Support\Facades\App;
use ReflectionClass;

/**
 * The CommandBus is a nifty piece of code.
 * 1. It creates a bit of PHP magic which takes in classes, converts them to
 *    names of another class, and then instantiates that class. Of course,
 *    this assumes a specific naming convention.
 *
 * 2. This create a centralized piece of logic from which every command in the system
 *    calls a command handler. So I could add logging or other stuff here and
 *    it would only be in this once place.
 */
class CommandBus
{
    // Command is a class that represents an action in the system that will cause
    // state to change.
    // The Command is also a class that represents the write model in CQRS.
    // ie, the command class is basically a model. They just call them commands instead of models.
    public function handle($command)
    {
        // ReflectionClass takes in a class and returns a new object with information
        // on said class.
        $reflection = new ReflectionClass($command); // ** CreateProductCommand **

        // Get the class's name and replace 'Command' with the word 'Handler'.
        // Why?
        // Each command has a command handler. The command handler takes in the
        // command/model and actually performs actions on it.
        // Since each command has a command handler, we're simply replacing the name here.
        $handlerName = str_replace("Command", "Handler", $reflection->getShortName());
        $handlerName = str_replace($reflection->getShortName(), $handlerName, $reflection->getName());

        // App is aware of class names, so this is creating a class using a string
        // which is the name of the class.
        $handler = App::make($handlerName); // ** CreateProductHandler **

        // Since the handler has an invoke method, we can use that without using
        // the new keyword.
        $handler($command); // CreateProductHandler(CreateProductCommand);
    }
}

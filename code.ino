/*
Code for a Particle Photon (but could probably be adapted to other devices and cloud providers)
to keep track of the open/closed state of a gate or door.
(C) 2020 ajs256, released under the MIT license.
*/


int gateSensor = D2; // Change this to the pin your sensor is attached to. 
//                      It should be on a normally-open connection to ground 
//                      (meaning the pin should be connected to ground when the door/gate is closed.)

bool gateClosed;

int CONN_LED = D7; // The code uses the onboard LED (D7 on the Photon) to indicate when it is disconnected from the cloud.

LEDStatus LED_OPEN(RGB_COLOR_RED, LED_PATTERN_BLINK, LED_SPEED_SLOW, LED_PRIORITY_IMPORTANT); // Flashing red
LEDStatus LED_CLOSED(RGB_COLOR_GREEN, LED_PATTERN_FADE, LED_SPEED_NORMAL, LED_PRIORITY_IMPORTANT); // Pulsing green

void setup() {
    Particle.variable("gateClosed", gateClosed); // Initialize a cloud variable called gateClosed and tie it to the local gateClosed variable. 
    pinMode(gateSensor, INPUT_PULLUP); // Initialize the sensor pin as a pull-up (reads LOW when connected to ground)
    pinMode(CONN_LED, OUTPUT); // Initialize the LED pin as an output
}

void loop() {
    if (digitalRead(gateSensor) == LOW) { // If the gate is closed...
        gateClosed = true; // Set the variable. We don't need to tell the cloud directly, it'll ask the board.
        LED_OPEN.setActive(false); // Turn off the LED signal for open
        LED_CLOSED.setActive(true); // Turn on the LED signal for closed
    } else { // If it's not closed, then it's open
        gateClosed = false; // Set the variable
        LED_OPEN.setActive(true); // Turn on the LED signal for open
        LED_CLOSED.setActive(false); // Turn off the LED signal for closed
    }
    if(Particle.disconnected()) { // If it's disconnected...
        digitalWrite(CONN_LED, HIGH); // turn the light on
    } else { // If it's connected...
        digitalWrite(CONN_LED, LOW); // turn it off
    }
}

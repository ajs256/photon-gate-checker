# photon-gate-checker

On a Particle Photon, expose a cloud variable that shows whether a gate/door is open or closed. The PHP script grabs that variable and shows it on a webpage.

## Steps

### Step 0: Setting Up
- [Set up your Photon, if you haven't already.](https://docs.particle.io/quickstart/photon/)
- [Install the Particle CLI.](https://docs.particle.io/tutorials/developer-tools/cli/)

### Step 1: Getting your Access Token and Device ID
- Make an access token. In a terminal with the CLI installed, run `particle token create --never-expires`. Take note of the token it outputs, like putting it into a password manager.
- Find your device ID: In a terminal, run `particle list`. The value in `[square brackets]` is the device ID. Take note of this too.

### Step 2: Flash the code
- Paste [the code](code.ino) into [the Particle web IDE](https://build.particle.io) and click :zap: to flash the code.
- Upload [the PHP page](checker.php) to your web server. (As this process can vary between providers and computers, I won't provide exact instructions.) Replace `YOUR_DEVICE_ID` with your device ID and `YOUR_BIG_LONG_ACCESS_TOKEN` with your big, long access token. Leave everything else as is unless you want to customize the page.

### Step 3: Connect it up
- Connect a [door sensor](https://adafru.it/375) to pin D2 on your Photon and any GND pin. Give the board power, and you're done!

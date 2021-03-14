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

## Bonus: Get the checker page as an app on your iPhone/iPad!

Using a configuration profile, you can make a "app" with the webpage! Here's how:
1. Download the [profile file](profile.mobileconfig). 
2. Open it in any text editor. 
3. There are two things you need to change:
    1. On line 29, change the URL to point to where you deployed the webpage.
    2. On line 35, change the ID to a random UUID, to ensure that updates overwrite the existing profile. You can generate one at [https://uuidgenerator.net](uuidgenerator.net).

### Installing the Profile
1. Get the profile to your device. You can do it via email, a webpage, or by deploying it through [Apple Configurator](https://apps.apple.com/us/app/apple-configurator-2/id1037126344?mt=12).
2. If it asks if you want to allow downloading a configuration profile, click Allow.
2. Open Settings. 
3. Under your name, you should see a "Profile Downloaded" option. Tap it.
4. Tap "Install" in the corner.
5. Enter your passcode.
6. Tap "Install" twice more.
Note that the app icon will be the [iOS default app icon](sample-icon.jpg), unless you customize it.

If you want to edit the profile more, such as customizing the name or adding an icon, open it in [Apple Configurator](https://apps.apple.com/us/app/apple-configurator-2/id1037126344?mt=12).

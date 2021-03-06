# Windows host setup

You need different tools depending on which target platforms you want to deploy your application to:

*   Deploy to Android: follow [Installation for Crosswalk Android](#documentation/getting_started/Windows_host_setup/Installation-for-Crosswalk-Android).
*   Deploy to Tizen: follow [Installation for Crosswalk Tizen](#documentation/getting_started/Windows_host_setup/Installation-for-Crosswalk-Tizen).

These instructions have been tested on Windows 7 Enterprise, 64 bit.

## Installation for Crosswalk Android

These steps will enable you to develop Crosswalk applications to run on Android:

1.  [Install Python](#documentation/getting_started/windows_host_setup/Install-Python).
2.  [Install the Oracle Java Development Kit (JDK)](#documentation/getting_started/windows_host_setup/Install-the-Oracle-JDK).
3.  [Install Ant](#documentation/getting_started/windows_host_setup/Install-Ant).
4.  [Configure the tools](#documentation/getting_started/windows_host_setup/Configure-the-tools).
5.  [Install the Android SDK](#documentation/getting_started/windows_host_setup/Install-the-Android-SDK).
6.  [Download the Crosswalk Android app template](#documentation/getting_started/windows_host_setup/Download-the-Crosswalk-Android-app-template).
7.  [Verify your environment](#documentation/getting_started/windows_host_setup/Verify-your-environment).

### Install Python

Get Python from http://www.python.org/downloads/, choosing an "MSI installer" for your architecture (32 or 64 bit).

When the installer starts, choose *Install for all users* and set **C:\python** as the installation location. You will need to manually add the Python directory to your path for it to be available in the bash shell (see [Configure your environment](#Configure-your-environment)).

### Install the Oracle JDK

The Oracle JDK has to be downloaded manually (you must accept a licence agreement):

1.  Go to the Oracle Java JDK download page in a browser:

    http://www.oracle.com/technetwork/java/javase/downloads/

    Choose the Java version to download (Java 7 is known to work).

2.  Choose a JDK download and accept the licence agreement.

3.  Once downloaded, run the Java <code>.exe</code> installer, and set <code>C:\jdk</code> as the installation directory.

### Install Ant

1.  Download Ant from: http://www.apache.org/dist/ant/binaries/

    Version 1.9.3 is known to work.

2.  Unzip it (using WinZip or similar) to your `C:` drive.

3.  Rename the unzipped directory to `ant`.

Your Ant installation should now be in `C:\ant`.

### Configure the tools

The next step is to set up your environment so that binaries and scripts which were installed manually (ant, JDK, Python) are on your `PATH`.

    > setx path "%path%;c:\python;c:\ant\bin;c:\jdk\bin"

### Install the Android SDK

1.  Download the Android SDK from <a href='http://developer.android.com/sdk/index.html' target='_blank'>http://developer.android.com/sdk/index.html</a>.

2.  Extract the files from the archive.

3.  Add the Android SDK directories to your `PATH`:

        > setx path "%path%;<path to Android SDK>"
        > setx path "%path%;<path to Android SDK>\sdk\tools
        > setx path "%path%;<path to Android SDK>\sdk\platform-tools"

    The `tools` and `platform-tools` directories may be in slightly different locations, depending on how you installed the SDK. Amend the above paths appropriately.

4.  Run the *SDK Manager*:

        > "SDK Manager.exe"

5.  In the SDK Manager window, select the following items from the list:

        [ ] Tools
          [x] Android SDK Platform-tools 19.0.1
          [x] Android SDK Build tools 18.0.1
        [ ] Android 4.3 (API 18)
          [x] SDK Platform

    Note that if you are using devices with versions of Android later than 4.3, you should install the platform tools, build tools and SDK platform for those versions too.

### Download the Crosswalk Android app template

The Crosswalk Android distribution contains an application template which can be used as a wrapper for an HTML5 application. It also includes a script which will convert a wrapped HTML5 application into an installable Android `apk` file.

To get Crosswalk Android:

1.  Download the version you want from the [Downloads page](#documentation/downloads). We suggest that you use the stable Android version (${XWALK-STABLE-ANDROID-X86}).

2.  Unzip it. You should now have a `crosswalk-${XWALK-STABLE-ANDROID-X86}` directory.

### Verify your environment

Check that you have installed the tools properly by running these commands:

    > java -version
    java version "1.7.0_45"
    Java(TM) SE Runtime Environment (build 1.7.0_45-b18)
    Java HotSpot(TM) 64-Bit Server VM (build 24.45-b08, mixed mode)

    > ant -version
    Apache Ant(TM) version 1.9.3 compiled on December 23 2013

    > python --version
    Python 2.7.6

    > adb help
    Android Debug Bridge version 1.0.31

## Installation for Crosswalk Tizen

In this tutorial, you're going to use an emulated Tizen IVI image, running under VMware. To be able to create this image and access it, you need to install a few packages on the host machine:

1. **Utilities**, available as part of the [git SCM tools for Windows](http://git-scm.com/download/win).

    <ul>
    <li><code>bash</code>: this is required to run the script for generating Tizen packages.</li>
    <li><code>ssh</code>: this command is used to push files to, and log in to, the virtual machine.</li>
    <li><code>openssl</code>: the command used to create a key for signing your Tizen packages.</li>
    <li><code>bunzip2</code>: the command to unpack the Tizen IVI disk image.</li>
    </ul>

    Download a git SCM tools `.exe` for your architecture and install it.

    Once installed, you should have a *Git Bash* entry in the Windows menu, which will bring up a `bash` shell.

2.  **QEMU:** you need the <code>qemu-img</code> tool to convert a Tizen IVI disk image into a format suitable for use with VMware.

    A version of QEMU for Windows is available from http://qemu.weilnetz.de/. Use this at your own risk.

3.  **VMware Player** or **VMware Workstation**, to create and run the virtual machine. The free version of Player can be downloaded from [the VMware website](https://my.vmware.com/web/vmware/free). However, if you are using Player for commercial purposes, you will [need a licence](http://store.vmware.com/buyplayerplus).

    If you need help with installing VMware products, see [this page on the VMware website](http://kb.vmware.com/selfservice/microsites/search.do?language=en_US&cmd=displayKC&externalId=2053973).

Now the host is setup, you can prepare your targets.

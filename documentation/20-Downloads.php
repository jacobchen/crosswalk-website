<!DOCTYPE html>
<html>
  <body>
    <h1>Downloads</h1>

    <p>The Crosswalk project provides binaries for multiple
    operating systems and platforms.</p>

    <p>For instructions on how to use these downloads, see the
    <a href="#documentation/getting_started">Getting started</a> pages.</p>

    <p>For more information about the release channels, see
    <a href="#Release-channels">the <em>Release channels</em> section</a>.</p>

    <p>For more about the meaning of the version numbers, see the
    <a href="#wiki/release-methodology/version-numbers">Release methodology</a>
    page.</p>

    <table class="downloads-table">

    <tr>
    <th>&nbsp;</th>
    <th>Stable</th>
    <th>Beta</th>
    <th>Canary</th>
    </tr>

    <tr>
    <th>Android</th>
    <td>
    <a data-role="static-download-link" data-channel="stable" data-os="android" data-arch="x86"></a>
    </td>
    <td>
    <a data-role="static-download-link" data-channel="beta" data-os="android" data-arch="x86"></a>
    </td>
    <td data-role="download-cell" data-loading="true">
    <a data-role="download-link" data-channel="canary" data-os="android" data-arch="x86"></a>
    </td>
    </tr>

    <tr>
    <th>Tizen 3.0 Mobile (x86)</th>
    <td>-</td>
    <td>-</td>
    <td data-role="download-cell" data-loading="true">
    <a data-role="download-link" data-channel="canary" data-os="tizen-mobile" data-arch="x86"></a>
    </td>
    </tr>

    <tr>
    <th>Tizen 3.0 IVI (x86)</th>
    <td>-</td>
    <td>-</td>
    <td data-role="download-cell" data-loading="true">
    <a data-role="download-link" data-channel="canary" data-os="tizen-ivi" data-arch="x86"></a>
    </td>
    </tr>

    </table>

    <p><a href="https://download.01.org/crosswalk/releases/crosswalk/">More downloads...</a></p>

    <h2>Release notes</h2>

    <ul>
    <li><a href="#wiki/Crosswalk-4-release-notes">Crosswalk-4</a></li>
    <li><a href="#wiki/Crosswalk-5-release-notes">Crosswalk-5</a></li>
    </ul>

    <p>Note that release notes are only produced for stable and beta
    versions.</p>

    <h2><a name="Release-channels"></a>Release channels</h2>

    <p>There are three release channels (in order of increasing
    instability):</p>

    <ol>
      <li>
        <p><strong>Stable</strong></p>

        <p>A Stable release is a release intended for end users. Once a
        Crosswalk release is promoted to the Stable channel, that
        release will only see new binaries for critical bugs and
        security issues.</p>
      </li>

      <li>
        <p><strong>Beta</strong></p>

        <p>A Beta release is intended primarily for application
        developers looking to test their application against
        any new changes to Crosswalk, or use new features due
        to land in the next Stable release. Beta builds are
        published based on automated basic acceptance tests (ABAT),
        manual testing results, and functionality changes. There is
        an expected level of stability with Beta releases; however,
        it is still Beta, and may contain significant bugs.</p>
      </li>

      <li>
        <p><strong>Canary</strong></p>

        <p>The Canary release is generated on a frequent basis
        (sometimes daily). It is based on a recent tip of master that
        passes a full build and automatic basic acceptance test. The
        Canary build is an easy option for developers who are interested
        in the absolute latest features, but don't want to build
        Crosswalk themselves.</p>
      </li>
    </ul>

    <p>More information is available on the
    <a href="#wiki/Release-methodology">Release Channels page</a>.</p>

    <p>The <a href="#contribute/channels-viewer">Channel Viewer</a>
    shows detailed information about the status of each release channel.</p>

    <p>The <a href="#wiki/release-methodology/version-numbers">Crosswalk
    version numbers page</a> describes how Crosswalk versions are assigned.</p>

    <script>
    populateStaticLinks();

    // populate any download links and release notes links after
    // fetching version info for a channel/branch
    var populateLinks = function (channel, branch) {
        // download links for this channel
        var sel = 'a[data-role="download-link"][data-channel="' + channel + '"]';
        var dlLinks = document.querySelectorAll(sel);

        var clearAllSpinners = function () {
            for (var i = 0; i < dlLinks.length; i++) {
                dlLinks.item(i).parentNode.setAttribute('data-loading', false);
            }
        };

        var githubError = function () {
            for (var i = 0; i < dlLinks.length; i++) {
                dlLinks.item(i).parentNode.innerHTML = 'github error';
            }
        };

        // get version for this branch
        var path = './github.php?fetch=version&branch=' + branch;
        asyncJsonGet(path, function (err, response) {
            if (err) {
                clearAllSpinners();
                githubError();
                return;
            }

            var i, link, url, text;
            var version = response.version;
            var majorVersion = getXwalkMajorVersion(version);

            // populate download links
            for (i = 0; i < dlLinks.length; i++) {
                link = dlLinks.item(i);
                link.innerHTML = version;
                link.href = getXwalkDownloadUrl(
                    link.getAttribute('data-os'),
                    link.getAttribute('data-arch'),
                    channel,
                    version
                );
            }

            clearAllSpinners();
        });
    };

    // get the branches; for each, populate the links corresponding
    // to the channel for that branch
    asyncJsonGet('./github.php', function (err, branches) {
        // on error, clear all the loading spinners for the whole table
        if (err) {
            var spinnerElts = document.querySelectorAll('[data-loading="true"]');
            var elt;
            for (var i = 0; i < spinnerElts.length; i++) {
                elt = spinnerElts.item(i);
                elt.setAttribute('data-loading', 'false');
                elt.innerHTML = 'github error';
            }
        }
        else {
            // iterate the branches; for each branch/channel, fetch the version
            // and populate any corresponding download links and release
            // note links
            var channel, branch;
            for (var i = 0; i < branches.length; i++) {
                channel = branches[i].channel;
                branch = branches[i].branch;
                populateLinks(channel, branch);
            }
        }
    });
    </script>
  </body>
</html>

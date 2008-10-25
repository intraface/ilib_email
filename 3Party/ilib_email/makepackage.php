<?php
/**
 * package.xml generation script
 *
 * @package antispambot
 * @author  Lars Olesen <lars@legestue.net>
 * @version @package-version@
 */

require_once 'PEAR/PackageFileManager2.php';

$version = '0.1.0';
$stability = 'alpha';
$notes = '* Initial release as PEAR package';

PEAR::setErrorHandling(PEAR_ERROR_DIE);
$pfm = new PEAR_PackageFileManager2();
$pfm->setOptions(
    array(
        'baseinstalldir'    => 'wordpress',
        'filelistgenerator' => 'file',
        'packagedirectory'  => dirname(__FILE__),
        'packagefile'       => 'package.xml',
        'ignore'            => array(
            'makepackage.php',
            '*.tgz'
            ),
        'dir_roles' => array(
        ),
        'exceptions'        => array(
        ),
        'simpleoutput'      => true,
    )
);

$pfm->setPackage('antispambot');
$pfm->setSummary('Obfuscate email');
$pfm->setDescription('A function to obfucate an email to protect against spam. Function is from Wordpress 2.2.');
$pfm->setChannel('public.intraface.dk');
$pfm->setLicense('GNU GENERAL PUBLIC LICENSE', 'http://www.gnu.org/copyleft/gpl.html');
$pfm->addMaintainer('lead', 'lsolesen', 'Lars Olesen', 'lars@legestue.net');


$pfm->setPackageType('php');

$pfm->setAPIVersion($version);
$pfm->setReleaseVersion($version);
$pfm->setAPIStability($stability);
$pfm->setReleaseStability($stability);
$pfm->setNotes($notes);
$pfm->addRelease();

$pfm->addGlobalReplacement('package-info', '@package-version@', 'version');

$pfm->clearDeps();
$pfm->setPhpDep('4.3.0');
$pfm->setPearinstallerDep('1.5.0');

$pfm->generateContents();

if (isset($_GET['make']) || (isset($_SERVER['argv']) && @$_SERVER['argv'][1] == 'make')) {
    if ($pfm->writePackageFile()) {
        exit('package file written');
    }
} else {
    $pfm->debugPackageFile();
}
?>
<?php
/**
 * This file is part of the zbateson\gpg-interface project.
 *
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */
namespace ZBateson\GpgInterface;

use Psr\Http\Message\StreamInterface;

/**
 * Provides an abstracted interface for gpg encryption, decryption, signing and
 * verification.
 *
 * @author Zaahid Bateson
 */
interface GpgInterface
{
    const VERIFY_VALID = 0x1;
    const VERIFY_INVALID = 0x4;

    /**
     * Returns a StreamInterface of the encrypted data contained in the passed
     * stream, or false on failure.
     *
     * @return StreamInterface|boolean
     */
    public function encrypt(StreamInterface $in);

    /**
     * Returns a StreamInterface of the decrypted data contained in the passed
     * stream, or false on failure.
     *
     * @return StreamInterface|boolean
     */
    public function decrypt(StreamInterface $in);

    /**
     * Returns the signed text or signature of the passed stream, or false on
     * failure.
     *
     * @return string|boolean
     */
    public function sign(StreamInterface $in);

    /**
     * Returns either GpgInterface::VERIFY_VALID or GpgInterface::VERIFY_INVALID
     * if the passed data has been signed with the passed $signature.  The
     * method returns false otherwise.
     *
     * @return boolean|int
     */
    public function verify(StreamInterface $in, $signature);
}

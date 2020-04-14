<?php
/**
 * This file is part of the zbateson/crypt-interface project.
 *
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */
namespace ZBateson\CryptInterface;

use Psr\Http\Message\StreamInterface;

/**
 * Provides an abstracted interface for cryptographic functions: encryption,
 * decryption, signing and verification.
 *
 * @author Zaahid Bateson
 */
interface ICrypt
{
    /**
     * Returns a StreamInterface of the encrypted data contained in the passed
     * stream, or false on failure.
     *
     * @param string|resource|StreamInterface
     * @return StreamInterface|boolean
     */
    public function encrypt($data);

    /**
     * Returns a StreamInterface of the decrypted data contained in the passed
     * stream, or false on failure.
     *
     * @param string|resource|StreamInterface
     * @return StreamInterface|boolean
     */
    public function decrypt($in);

    /**
     * Returns the signed text or signature of the passed stream, or false on
     * failure.
     *
     * @param string|resource|StreamInterface $in
     * @return string|boolean
     */
    public function sign($in);

    /**
     * Returns either true if the passed data has been signed with the passed
     * $signature and has been verified, or false otherwise.
     *
     * @param string|resource|StreamInterface $in
     * @param string $signature
     * @return boolean
     */
    public function verify($in, $signature);

    /**
     * Returns true if the passed mimetype is supported, either for
     * encryption/decryption or signing/verifying.
     *
     * @return boolean
     */
    public function isSupported($mimeType);
}

<?php
/**
 * This file is part of the zbateson\gpg-interface project.
 *
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */
namespace ZBateson\GpgInterface;

use Psr\Http\Message\StreamInterface;
use GuzzleHttp\Psr7;

/**
 * Simple implementation of GpgInterface that users can inherit from.
 *
 * Defines abstract methods with StreamInterface parameters, calling them after
 * creating a Stream out of the passed data to encrypt/decrypt/sign and verify.
 *
 * @author Zaahid Bateson
 */
abstract class AbstractGpg implements GpgInterface
{
    /**
     * Returns a StreamInterface of the encrypted data contained in the passed
     * stream, or false on failure.
     *
     * @param string|resource|StreamInterface
     * @return StreamInterface|boolean
     */
    public function encrypt($data)
    {
        return $this->encryptStream(Psr7\stream_for($data));
    }

    /**
     * Override to implement stream encryption.
     *
     * @return StreamInterface|boolean
     */
    protected abstract function encryptStream(StreamInterface $in);

    /**
     * Returns a StreamInterface of the decrypted data contained in the passed
     * stream, or false on failure.
     *
     * @param string|resource|StreamInterface
     * @return StreamInterface|boolean
     */
    public function decrypt($in)
    {
        return $this->decryptStream(Psr7\stream_for($in));
    }

    /**
     * Override to implement stream decryption
     *
     * @return StreamInterface|boolean
     */
    protected abstract function decryptStream(StreamInterface $in);

    /**
     * Returns the detached signature of the passed stream, or false on failure.
     *
     * @param string|resource|StreamInterface $in
     * @return string|boolean
     */
    public function sign($in)
    {
        return $this->signStream(Psr7\stream_for($in));
    }

    /**
     * Override to implement stream signing
     *
     * @return string|boolean
     */
    protected abstract function signStream(StreamInterface $in);

    /**
     * Returns either true if the passed data has been signed with the passed
     * detached $signature and has been verified, or false otherwise.
     *
     * @param string|resource|StreamInterface $in
     * @param string $signature
     * @return boolean
     */
    public function verify($in, $signature)
    {
        return $this->verifyStream(Psr7\stream_for($in), $signature);
    }

    /**
     * Override to implement stream verification for a detached signature.
     *
     * @return boolean
     */
    protected abstract function verifyStream(StreamInterface $in, $signature);
}

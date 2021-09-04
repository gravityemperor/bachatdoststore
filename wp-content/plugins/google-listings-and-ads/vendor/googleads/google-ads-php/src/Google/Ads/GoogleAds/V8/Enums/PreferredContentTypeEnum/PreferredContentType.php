<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/ads/googleads/v8/enums/preferred_content_type.proto

namespace Google\Ads\GoogleAds\V8\Enums\PreferredContentTypeEnum;

use UnexpectedValueException;

/**
 * Enumerates preferred content criterion type.
 *
 * Protobuf type <code>google.ads.googleads.v8.enums.PreferredContentTypeEnum.PreferredContentType</code>
 */
class PreferredContentType
{
    /**
     * Not specified.
     *
     * Generated from protobuf enum <code>UNSPECIFIED = 0;</code>
     */
    const UNSPECIFIED = 0;
    /**
     * The value is unknown in this version.
     *
     * Generated from protobuf enum <code>UNKNOWN = 1;</code>
     */
    const UNKNOWN = 1;
    /**
     * Represents top content on YouTube.
     *
     * Generated from protobuf enum <code>YOUTUBE_TOP_CONTENT = 400;</code>
     */
    const YOUTUBE_TOP_CONTENT = 400;

    private static $valueToName = [
        self::UNSPECIFIED => 'UNSPECIFIED',
        self::UNKNOWN => 'UNKNOWN',
        self::YOUTUBE_TOP_CONTENT => 'YOUTUBE_TOP_CONTENT',
    ];

    public static function name($value)
    {
        if (!isset(self::$valueToName[$value])) {
            throw new UnexpectedValueException(sprintf(
                    'Enum %s has no name defined for value %s', __CLASS__, $value));
        }
        return self::$valueToName[$value];
    }


    public static function value($name)
    {
        $const = __CLASS__ . '::' . strtoupper($name);
        if (!defined($const)) {
            throw new UnexpectedValueException(sprintf(
                    'Enum %s has no value defined for name %s', __CLASS__, $name));
        }
        return constant($const);
    }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(PreferredContentType::class, \Google\Ads\GoogleAds\V8\Enums\PreferredContentTypeEnum_PreferredContentType::class);


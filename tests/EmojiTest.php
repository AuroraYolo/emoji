<?php

namespace Spatie\Emoji\Test;

use Spatie\Emoji\Emoji;
use PHPUnit\Framework\TestCase;
use Spatie\Emoji\Exceptions\UnknownCharacter;
use Spatie\Emoji\Exceptions\CouldNotDetermineFlag;

class EmojiTest extends TestCase
{
    /** @test */
    public function it_can_return_an_emoji_character_when_given_a_constant()
    {
        $this->assertSame('😀', Emoji::CHARACTER_GRINNING_FACE);
    }

    /** @test */
    public function it_provides_a_convenience_method_to_return_emoji_characters()
    {
        $this->assertSame('😀', Emoji::grinningFace());
    }

    /** @test */
    public function it_can_return_the_skin_tone_component_emoji()
    {
        $this->assertSame('🏻', Emoji::lightSkinTone());
    }

    /** @test */
    public function it_will_throw_an_exception_when_getting_unknown_characters()
    {
        $this->expectException(UnknownCharacter::class);

        Emoji::thisCharacterDoesNotExist();
    }

    /** @test */
    public function it_will_return_an_emoji_character_when_given_a_language_code()
    {
        $this->assertSame('🇧🇪', Emoji::countryFlag('BE'));
        $this->assertSame('🇧🇪', Emoji::countryFlag('be'));
        $this->assertSame('🇦🇦', Emoji::countryFlag('AA'));
    }

    /**
     * @test
     *
     * @dataProvider invalidCountryCodeProvider
     */
    public function it_will_throw_an_exception_when_try_to_get_a_flag_for_a_string_that_doesnt_have_two_characters(string $invalidCountryCode)
    {
        $this->expectException(CouldNotDetermineFlag::class);

        Emoji::countryFlag($invalidCountryCode);
    }

    public function invalidCountryCodeProvider()
    {
        return [
            [''],
            ['a'],
            ['aaa'],
        ];
    }
}

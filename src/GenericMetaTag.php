<?php

namespace ilateral\SilverStripe\GenericMetaTags;

use SilverStripe\TagManager\SnippetProvider;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\View\ArrayData;

/**
 * A snippet provider that lets you add arbitrary HTML
 */
class MetaTag implements SnippetProvider
{

    public function getTitle()
    {
        return "Meta Tag";
    }

    public function getSummary(array $params)
    {
        return $params['TagName'];
    }

    public function getParamFields()
    {
        return FieldList::create(
            TextField::create(
                "TagName",
                "Tag Name"
            ),
            TextField::create(
                "TagContent",
                "Tag Content"
            ),
        );
    }

    public function getSnippets(array $params)
    {
        if (empty($params['TagName']) && empty($params['TagContent'])) {
            return [];
        }

        $snippet = ArrayData::create($params)
            ->renderWith(static::class)
            ->raw();

        return [
            SnippetProvider::ZONE_HEAD_START => $snippet
        ];
    }
}
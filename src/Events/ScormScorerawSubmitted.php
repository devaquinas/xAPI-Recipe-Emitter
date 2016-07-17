<?php namespace XREmitter\Events;

class ScormScorerawSubmitted extends Event {
    protected static $verb_display = [
        'en' => 'completed'
    ];

    /**
     * Reads data for an event.
     * @param [String => Mixed] $opts
     * @return [String => Mixed]
     * @override Event
     */
    public function read(array $opts) {
        return array_merge_recursive(parent::read($opts), [
            'verb' => [
                'id' => 'http://adlnet.gov/expapi/verbs/completed',
                'display' => $this->readVerbDisplay($opts),
            ],
            'result' => [
                'score' => [
                    'raw' => $opts['scorm_score_raw'],
                    'min' => $opts['scorm_score_min'],
                    'max' => $opts['scorm_score_max'],
                    'scaled' => $opts['scorm_score_scaled']
                ],
            ],
            'object' => $this->readModule($opts),
            'context' => [
                'contextActivities' => [
                    'grouping' => [
                        $this->readCourse($opts),
                    ],
                ],
            ],
        ]);
    }
}

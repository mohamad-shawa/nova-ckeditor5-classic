<?php

namespace  NumaxLab\NovaCKEditor5Classic\Models;

use Illuminate\Http\Request;

class DeleteAttachments
{
    /**
     * The field instance.
     *
     * @var \Laravel\Nova\Fields\Trix
     */
    public $field;

    /**
     * Create a new class instance.
     *
     * @param  \Laravel\Nova\Fields\Trix  $field
     * @return void
     */
    public function __construct($field)
    {
        $this->field = $field;
    }

    /**
     * Delete the attachments associated with the field.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $model
     * @return void
     */
    public function __invoke(Request $request, $model)
    {
        Attachment::where('attachable_type', get_class($model))
                ->where('attachable_id', $model->getKey())
                ->get()
                ->each
                ->purge();

        return [$this->field->attribute => ''];
    }
}
 22  src/Models/DetachAttachment.php 
@@ -0,0 +1,22 @@
<?php

namespace  NumaxLab\NovaCKEditor5Classic\Models;

use Illuminate\Http\Request;

class DetachAttachment
{
    /**
     * Delete an attachment from the field.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function __invoke(Request $request)
    {
        Attachment::where('url', $request->attachmentUrl)
                        ->get()
                        ->each
                        ->purge();
    }
}

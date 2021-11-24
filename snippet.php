// If your website does not use Pricing, Products, etc. in any way, these snippets will remove the fields and groupings.


// Remove Pricing Fields from the Editor
// Ref https://docs.gravityforms.com/gform_field_groups_form_editor/

add_filter( 'gform_field_groups_form_editor', function( $field_groups ) {

    unset( $field_groups['pricing_fields'] );

    return $field_groups;

} );



// Remove Currency dropdown in Settings
// Ref https://docs.gravityforms.com/gform_currency_disabled/

add_filter( 'gform_currency_disabled', '__return_false' );



// Remove Pricing Fields from the Export Fields options
// Ref https://docs.gravityforms.com/gform_export_fields/#2-remove-fields

add_filter( 'gform_export_fields', function ( $form ) {
// Only limit the fields available for export form form ID 3. UNCOMMENT the following 'if' statement if you want to control only a single form.
// Uncomment the last closing bracket too.
	
//    if ( $form['id'] == 3 ) {

	// array of field IDs I never want to see on the export page
        $fields_to_remove = array(
            'payment_amount',
            'payment_date',
            'payment_status',
            'transaction_id',
        );
 
        foreach ( $form['fields'] as $key => $field ) {
            $field_id = is_object( $field ) ? $field->id : $field['id'];
            if ( in_array( $field_id, $fields_to_remove ) ) {
                unset ( $form['fields'][ $key ] );
            }
        }
//    } 
 
    // always return the form
    return $form;
} );

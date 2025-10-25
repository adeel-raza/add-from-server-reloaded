/**
 * Add From Server Reloaded - JavaScript
 *
 * @package Add From Server Reloaded
 * @since   4.0.0
 */

jQuery( document ).ready( function( $ ) {
	
	// Handle "show hidden files" toggle button.
	$( '#afsr-toggle-hidden' ).on( 'click', function() {
		var $button = $(this);
		var $table = $( '.afsr-file-table' );
		
		if ( $table.hasClass( 'showhidden' ) ) {
			// Hide hidden files.
			$table.removeClass( 'showhidden' );
			$button.text( 'Show Hidden Files' );
		} else {
			// Show hidden files.
			$table.addClass( 'showhidden' );
			$button.text( 'Hide Hidden Files' );
		}
	} );
	
	// Handle "show hidden files" toggle link (legacy).
	$( 'tr.hidden-toggle a' ).on( 'click', function( e ) {
		e.preventDefault();
		$(this).parents( 'table' ).addClass( 'showhidden' );
		$( '#afsr-toggle-hidden' ).text( 'Hide Hidden Files' );
	} );

	// Handle "select all" checkboxes.
	$( '#afsr-select-all, #afsr-select-all-footer' ).on( 'change', function() {
		var isChecked = $(this).prop( 'checked' );
		$( '.afsr-file-table tbody input[type="checkbox"]:not(:disabled):visible' ).prop( 'checked', isChecked );
		// Sync both select-all checkboxes.
		$( '#afsr-select-all, #afsr-select-all-footer' ).prop( 'checked', isChecked );
	} );

	// Sync both select-all checkboxes when individual files are selected.
	$( '.afsr-file-table tbody input[type="checkbox"]' ).on( 'change', function() {
		var totalCheckboxes = $( '.afsr-file-table tbody input[type="checkbox"]:not(:disabled)' ).length;
		var checkedCheckboxes = $( '.afsr-file-table tbody input[type="checkbox"]:not(:disabled):checked' ).length;
		
		$( '#afsr-select-all, #afsr-select-all-footer' ).prop( 
			'checked', 
			totalCheckboxes === checkedCheckboxes && totalCheckboxes > 0 
		);
	} );

	// Handle form submission with progress feedback.
	$( '#afsr-import-form' ).on( 'submit', function( e ) {
		var selectedFiles = $( 'input[name="files[]"]:checked' ).length;
		var selectedFolders = $( 'input[name="folders[]"]:checked' ).length;
		
		if ( selectedFiles === 0 && selectedFolders === 0 ) {
			e.preventDefault();
			alert( 'Please select at least one file or folder to import.' );
			return false;
		}

		// Show progress indicator.
		var statusEl = $( '.afsr-import-status' );
		var message = 'Importing ';
		if ( selectedFiles > 0 && selectedFolders > 0 ) {
			message += selectedFiles + ' file(s) and ' + selectedFolders + ' folder(s)...';
		} else if ( selectedFiles > 0 ) {
			message += selectedFiles + ' file(s)...';
		} else {
			message += selectedFolders + ' folder(s)...';
		}
		statusEl.html( '<span class="spinner is-active" style="float:none;"></span> ' + message );
		
		// Disable submit button to prevent double-submission.
		$( '#afsr-import-form input[type="submit"]' ).prop( 'disabled', true );
		
		// Allow form to submit normally.
		return true;
	} );

	// File search functionality.
	if ( $( '.afsr-file-table' ).length ) {
		
		// Add search box before the table.
		$( '.afsr-file-table' ).before( 
			'<div class="afsr-search-box" style="margin-bottom: 10px;">' +
			'<input type="text" id="afsr-file-search" class="regular-text" placeholder="Search files..." />' +
			'<button type="button" class="button" id="afsr-clear-search">Clear</button>' +
			'</div>'
		);

		// Prevent Enter key from submitting form in search box.
		$( document ).on( 'keydown', '#afsr-file-search', function( e ) {
			if ( e.keyCode === 13 ) {
				e.preventDefault();
				e.stopPropagation();
				return false;
			}
		} );

		// Handle file search.
		$( '#afsr-file-search' ).on( 'keyup', function() {
			var searchTerm = $(this).val().toLowerCase().trim();
			
			// No search term - show everything normally.
			if ( searchTerm === '' ) {
				$( '.afsr-file-table tbody tr' ).not( '.hidden-toggle' ).show().css( 'opacity', '1' );
				return;
			}

			// Search active - only show matching items.
			$( '.afsr-file-table tbody tr' ).each( function() {
				var $row = $(this);
				var isHiddenToggle = $row.hasClass( 'hidden-toggle' );
				
				// Skip the "show hidden" toggle row.
				if ( isHiddenToggle ) {
					return;
				}
				
				// Get the file/folder name.
				var itemName = $row.find( 'label' ).text().toLowerCase();
				
				// Show only matching items, hide everything else.
				if ( itemName.indexOf( searchTerm ) !== -1 ) {
					$row.show().css( 'opacity', '1' );
				} else {
					$row.hide();
				}
			} );
		} );

		// Handle clear search button.
		$( '#afsr-clear-search' ).on( 'click', function() {
			$( '#afsr-file-search' ).val( '' ).trigger( 'keyup' );
		} );
	}

	// File size display enhancement.
	$( '.afsr-file-table tbody tr' ).each( function() {
		var checkbox = $(this).find( 'input[type="checkbox"]' );
		
		if ( checkbox.length && checkbox.prop( 'disabled' ) ) {
			$(this).addClass( 'afsr-disabled-row' );
		}
	} );

	// Keyboard shortcuts.
	$( document ).on( 'keydown', function( e ) {
		// Ctrl/Cmd + A to select all files.
		if ( ( e.ctrlKey || e.metaKey ) && e.keyCode === 65 && $( '.afsr-file-table' ).length ) {
			e.preventDefault();
			$( '#afsr-select-all' ).prop( 'checked', true ).trigger( 'change' );
		}
		
		// Escape to clear search.
		if ( e.keyCode === 27 && $( '#afsr-file-search' ).length ) {
			$( '#afsr-file-search' ).val( '' ).trigger( 'keyup' );
		}
	} );

	// Add confirmation for large imports.
	var originalSubmit = $( '#afsr-import-form' ).get(0);
	if ( originalSubmit ) {
		$( '#afsr-import-form' ).on( 'submit', function( e ) {
			var selectedFiles = $( 'input[name="files[]"]:checked' ).length;
			var selectedFolders = $( 'input[name="folders[]"]:checked' ).length;
			var totalSelected = selectedFiles + selectedFolders;
			
			if ( totalSelected > 50 || selectedFolders > 5 ) {
				var message = 'You are about to import ';
				if ( selectedFiles > 0 && selectedFolders > 0 ) {
					message += selectedFiles + ' file(s) and ' + selectedFolders + ' folder(s).';
				} else if ( selectedFiles > 0 ) {
					message += selectedFiles + ' file(s).';
				} else {
					message += selectedFolders + ' folder(s).';
				}
				message += ' This may take a while. Continue?';
				
				if ( ! confirm( message ) ) {
					e.preventDefault();
					$( '.afsr-import-status' ).html( '' );
					$( '#afsr-import-form input[type="submit"]' ).prop( 'disabled', false );
					return false;
				}
			}
		} );
	}

	// Add file count indicator.
	function updateFileCount() {
		var totalFiles = $( 'input[name="files[]"]:not(:disabled)' ).length;
		var selectedFiles = $( 'input[name="files[]"]:not(:disabled):checked' ).length;
		var totalFolders = $( 'input[name="folders[]"]:not(:disabled)' ).length;
		var selectedFolders = $( 'input[name="folders[]"]:not(:disabled):checked' ).length;
		
		var countText = '';
		if ( selectedFiles > 0 || selectedFolders > 0 ) {
			if ( selectedFiles > 0 && selectedFolders > 0 ) {
				countText = selectedFiles + ' file(s) and ' + selectedFolders + ' folder(s) selected';
			} else if ( selectedFiles > 0 ) {
				countText = selectedFiles + ' of ' + totalFiles + ' file(s) selected';
			} else {
				countText = selectedFolders + ' of ' + totalFolders + ' folder(s) selected';
			}
		}
		
		if ( $( '.afsr-file-count' ).length === 0 ) {
			$( '.afsr-import-status' ).before( '<span class="afsr-file-count" style="margin-left: 15px; color: #666;"></span>' );
		}
		
		$( '.afsr-file-count' ).text( countText );
	}

	// Update count on checkbox change.
	$( '.afsr-file-table tbody input[type="checkbox"], #afsr-select-all, #afsr-select-all-footer' ).on( 'change', function() {
		updateFileCount();
	} );

	// Initial count update.
	if ( $( '.afsr-file-table' ).length ) {
		updateFileCount();
	}

	// Add tooltips for disabled files.
	$( '.afsr-file-table tbody tr[title]' ).each( function() {
		var title = $(this).attr( 'title' );
		if ( title ) {
			$(this).find( 'label' ).attr( 'title', title );
		}
	} );

} );

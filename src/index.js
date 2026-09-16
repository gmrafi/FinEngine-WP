import { registerBlockType } from '@wordpress/blocks';
import './style.scss';
import './editor.scss';
import metadata from './block.json';
import Edit from './edit';
import save from './save';
import './frontend/calculator-runtime';

registerBlockType(metadata.name, {
  edit: Edit,
  save
});
